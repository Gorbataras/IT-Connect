<?php
/**
MIT License

Copyright (c) 2018 Michael Lant, Bogdan Pshonyak, Yegor Shemereko, Abdalla M. Abdalla

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
 */


/**
 * Main controller that redirects to different pages
 * @author Taras Gorbachevskiy
 * @author Chad Drennan
 * @author Marcos Rivera
 * 2020-5-7
 */
class Controller
{
    // Quantity to show for each item on home page
    const BLOG_POST_QTY = 3;
    const EVENT_QTY = 5;

    // Domains used to identify APIs
    const MEETUP_DOMAIN = 'www.meetup.com';
    const MEDIUM_DOMAIN = 'medium.com';

    //Link to be manipulated. "placeholder" will be replaced
    const MEETUP_API_URL = 'https://api.meetup.com/placeholder/events?&sign=true&photo-host=public';
    const MEDIUM_API_URL = 'https://api.rss2json.com/v1/api.json?rss_url=https://medium.com/feed/';

    // Db context
    private $_htmlContentDb;

    // Base instance for Fat-Free Framework
    private $_f3;


    /**
     * Controller constructor.
     * @param $f3 Fat-Free Base object
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->_htmlContentDb = new htmlContent();

        $this->getColor();

        // If a site title is returned set to hive
        if ($result = $this->_htmlContentDb->getContent('header', 'title')) {
            $f3->set('siteTitle', $result[0]['html']);

            // Remove HTML tags and '$nbsp;' for site tab title
            $f3->set('siteTabTitle', str_replace('&nbsp;', '', strip_tags($result[0]['html'])));
        }

        //If a image extension is returned set to hive
        if ($result = $this->_htmlContentDb->getContent('site', 'logo')) {
            $f3->set('logoType', $result[0]['html']);
        }
    }


    /**
     * Redirect to the introduction page
     */
    function introduction()
    {
        // Get internships, Meetup events, blog posts and HTML content

        $internships = (new PostingsModel())->getSamplePostings();
        $meetupList = $this->getRecentMeetups(true);
        $blog = $this->getRecentBlogPosts();
        $content = $this->_htmlContentDb->getAllPageContent('home');

        // Set to hive
        $this->_f3->set('array', $meetupList);
        $this->_f3->set('posts', $internships);
        $this->_f3->set('blog', $blog);
        $this->_f3->set('content', $content);

        echo Template::instance()->render('views/introduction.php');
    }


    /**
     * Retrieves the most recent blog posts from api and formats the data
     * @return array 3 most recent blog posts
     */
    private function getRecentBlogPosts() {
        $row = $this->_htmlContentDb->getApiSourceNamesByDomain(self::MEDIUM_DOMAIN);

        $srcName = '';

        // Preconditions
        if (empty($row) || empty($row[0]['source_name'])) {
            return null;
        }
        else {
            $srcName = $row[0]['source_name'];
        }

        $url = self::MEDIUM_API_URL . $srcName;

        // Medium blog must be a valid url
        if (!(new Validator($this->_f3))->isValidUrl($url)) {
            return null;
        }

        // Retrieve Medium JSON query results from Medium RSS feed
        $result = json_decode(file_get_contents(self::MEDIUM_API_URL . $srcName), true);

        // Separate posts from comments, take only 3 posts
        $posts = [];
        $count = 0;

        // Format and take 3 most recent
        foreach ($result['items'] as $currPost) {

            // Separate posts from comments
            if (!empty($currPost['categories'])) {

                // Get first paragraph and cap its length
                // @ to suppress irrelevant error caused by data.
                $doc = new DOMDocument();
                @$doc->loadHTML(mb_convert_encoding($currPost['content'], "HTML-ENTITIES", "UTF-8"));
                $firstParagraph = $doc->getElementsByTagName('p')[0]->nodeValue;

                // Use placeholder if no paragraph content
                if (empty($firstParagraph)) {
                    $currPost['content'] = "No sample content available";
                }
                else {
                    $currPost['content'] = substr($firstParagraph, 0, 150) . '... read more';
                }

                // Format date, ex Dec 30
                $time = strtotime($currPost['pubDate']);
                $currPost['pubDate'] = date('M j', $time);

                // Collect post
                $posts[] = $currPost;
                $count++;

                // Take only 3
                if ($count == self::BLOG_POST_QTY) {
                    break;
                }
            }
        }
        return $posts;
    }


    /**
     * Compare function to sort by recent date
     * @param $a String date of item
     * @param $b String date of another item
     * @return int positive if sorted by most recent, negative if by least recent, 0 if equal
     */
    private static function sortFunction($a, $b)
    {
        return strtotime($a["local_date"]) - strtotime($b["local_date"]);
    }


    /**
     * redirect to the internship page
     */
    function internship()
    {
		$this->_f3->set('internshipsHeader',
			$this->_htmlContentDb->getContent('internships','internships'));

        // show the internship page
        echo Template::instance()->render('views/internships.php');
    }


    /**
     * redirect to the student resources page
     */
    function studentResources()
    {
        // Gather content
        $content = $this->_htmlContentDb->getAllPageContent('resources');

        // Set hive variables
        $this->_f3->set('content', $content);

        //  show the student resources page
        echo Template::instance()->render('views/studentResources.php');
    }


    /**
     * Logs admin into website
     */
    function login()
    {
        if ($_SESSION["validUser"] == true){
            $this->_f3->reroute('/adminPage');
        }

        // Login attempt
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $config = include("/home/nwagreen/config.php");
            $dbh = new PDO($config["db"], $config["username"], $config["password"]);

            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            $validator = new Validator($this->_f3);

            if ($validator->validEmail($email) && $validator->validPassword($password)
                && ((new login($dbh))->checkLogin($email, $password))) {

                $_SESSION['validUser'] = true;
                $this->_f3->reroute('/adminPage');
            }
            else {
                $this->_f3->set('email', $email);
                $this->_f3->set('password', $password);
            }
        }

        echo Template::instance()->render('views/login.php');
    }


    /**
     * Registers admin into website
     */
    function register()
    {
        //  show the admin Login page
        echo Template::instance()->render('gatorLock/register.php');
    }


    /**
     * Shows all editable site content
     */
    function adminPage()
    {
        if (!$_SESSION["validUser"]) {
            $this->_f3->reroute('/login');
        }

        // Get HTML content, blog source, Meetup Groups
        $homeContent = $this->_htmlContentDb->getAllPageContent('home');
        $resourcesContent = $this->_htmlContentDb->getAllPageContent('resources');
		$meetupHeader = $this->_htmlContentDb->getContent('events', 'events');
		$internshipsHeader = $this->_htmlContentDb->getContent('internships', 'Internships');

        $blogSourceName = $this->getBlogSourceName();
        $meetupGroupsList = $this->_htmlContentDb->getApiSourceNamesByDomain(self::MEETUP_DOMAIN);

        // Set to hive
		$this->_f3->set('eventsHeader', $meetupHeader);
		$this->_f3->set('internshipsHeader', $internshipsHeader);
        $this->_f3->set('homeContent', $homeContent);
        $this->_f3->set('resourcesContent', $resourcesContent);
        $this->_f3->set('blogSourceName', $blogSourceName);
        $this->_f3->set('meetupGroupsList', $meetupGroupsList);

        echo Template::instance()->render('views/adminPage.php');
    }


    /**
     * Gets the name of the of the blog source from the database or null if none
     * @return mixed|null name of blog source
     */
    private function getBlogSourceName()
    {
        $row = $this->_htmlContentDb->getApiSourceNamesByDomain(self::MEDIUM_DOMAIN);

        if (!empty($row)) {
            return $row[0]['source_name'];
        }
        return null;
    }


    /**
     * Add new Meetup group to Db
     */
    function addMeetupGroup()
    {
        if (!$_SESSION["validUser"] || $_SERVER['REQUEST_METHOD'] != 'POST'){
            return;
        }

        $groupName = $_POST['new-group'];

        //Create a URL
        $meetupLink = str_replace('placeholder', $groupName, self::MEETUP_API_URL);

        //If the entry does not already exist, add to db
        if (!$this->_htmlContentDb->apiSourceNameDoesExist(self::MEETUP_DOMAIN, $groupName)
                && (new Validator($this->_f3))->isValidUrl($meetupLink)) {

            // Error if not successful insert
            if (!$this->_htmlContentDb->addApiSourceName(self::MEETUP_DOMAIN,$groupName)) {
                echo "Error: $groupName could not be saved";
            }
        } else {
            echo "Error: The following group name is either invalid or already is added: $groupName";
        }
    }


    /**
     * Remove a Meetup group from JSON file
     */
    function deleteMeetupGroup()
    {
        if (!$_SESSION["validUser"] || $_SERVER['REQUEST_METHOD'] != 'POST'){
            return;
        }

        $groupName = $_POST['entry'];

        // Delete existing group from the db
        if ($this->_htmlContentDb->apiSourceNameDoesExist(self::MEETUP_DOMAIN, $groupName)) {

            // Give error if not successful delete
            if (!$this->_htmlContentDb->deleteApiSourceName(self::MEETUP_DOMAIN, $groupName)) {
                echo "Error: $groupName could not be deleted";
            }
        }
    }


    /**
     * Shows all upcoming Meetup events for saved meetup groups
     */
    function upcomingEvents()
    {
    	$this->_f3->set('eventsHeader',
			$this->_htmlContentDb->getContent('events','events'));

        $meetupList = $this->getRecentMeetups(false);

        //Add the list to fat free hive
        $this->_f3->set('upcomingEvents', $meetupList);

        echo Template::instance()->render('views/upcomingEvents.php');
    }


    /**
     * Logs admin out of the website
     */
    function logout()
    {
        unset($_SESSION['validUser']);

        // send to main page
        $this->_f3->reroute('/');
        exit;
    }

    function updateApiSource() {
        if (!$_SESSION["validUser"] || $_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $blogSourceName = trim($_POST['blogSourceName']);

        // Test first part of api url with source name
        $url = self::MEDIUM_API_URL . $blogSourceName;

        // Medium blog must be a valid url
        if (!(new Validator($this->_f3))->isValidUrl($url)) {
            echo "Error: The submitted Medium source ($blogSourceName) link does not work. No changes were saved.";
            return;
        }

        // Save blog source name
        if (!$this->_htmlContentDb->updateApiSourceNameByDomain(self::MEDIUM_DOMAIN, $blogSourceName)) {
            echo 'Error: "' .  str_replace('-', ' ', $blogSourceName) . '" was not saved.';
        }
    }


    function editHtmlContent()
    {
        if (!$_SESSION["validUser"] || $_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $contentItem = $_POST['htmlContent'];

        // Collect variables
        $page = $contentItem['page'];
        $contentName = $contentItem['contentName'];
        $html = $contentItem['html'];
        $isShown = $contentItem['isShown'] == 'true' ? 1 : 0;

        // Save HTML content
        if (!$this->_htmlContentDb->setContent($page, $contentName, $html, $isShown)) {
            echo 'Error: "' .  str_replace('-', ' ', $contentName) . '" was not saved.';
        }
    }


    /**
     * Collect recent Meetup events from all the site's Meetup groups sorted be recent date
     * @param $hasLimit boolean true if only want to return 5 of most recent Meetup events
     * @return array Meetup event data
     */
    private function getRecentMeetups($hasLimit)
    {
        //Retrieve list of sources
        $meetupGroupsList = $this->_htmlContentDb->getApiSourceNamesByDomain(self::MEETUP_DOMAIN);

        //Store meetups
        $meetupList = array();

        // Send request for each source
        foreach ($meetupGroupsList as $source) {

            // make link for the current source
            $currSource = str_replace('placeholder', $source['source_name'], self::MEETUP_API_URL);

            // Skip invalid links
            if (!(new Validator($this->_f3))->isValidUrl($currSource)) {
                continue;
            }

            //Make request to meetup api
            $response = file_get_contents($currSource);
            $response = json_decode($response, 1);

            //limit 5 events for each group
            $counter = 0;

            //Add each event from request to array
            foreach ($response as $event) {

                //add event to list
                array_push($meetupList, $event);
                $counter++;

                //Check for limit reached
                if ($hasLimit && $counter == self::EVENT_QTY) {
                    break;
                }
            }
        }
        //Sort the entries using custom comparison function
        usort($meetupList, ["Controller", "sortFunction"]);

        // Return only 5 most recent events if has limit
        if ($hasLimit) {
            return array_slice($meetupList, 0, self::EVENT_QTY);
        }
        return $meetupList;
    }
    
    /**
    *  Set color scheme for website.
    */
    function setColor()
    {
        if (!$_SESSION["validUser"] || $_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $config = include("/home/nwagreen/config.php");
        $dbh = new PDO($config["db"], $config["username"], $config["password"]);
        $siteSetting = new siteSetting($dbh);

        //get's the color from the color picker.
        $color1 = $_POST['color1'];
        $color2 = $_POST['color2'];
        $color3 = $_POST['color3'];

        //updates the color on the database.
         if (!$siteSetting->setColor($color1,1) || !$siteSetting->setColor($color2,2) ||
                !$siteSetting->setColor($color3,3) ) {
             echo "Error: Not all colors saved successfully";
         }
    }
    
    /**
    * Retrieves colors for website scheme
    */
    function getColor()
    {
        $config = include("/home/nwagreen/config.php");
        $dbh = new PDO($config["db"], $config["username"], $config["password"]);

        $siteSetting = new siteSetting($dbh);
        $color1 =  $siteSetting->getColor1();
        $color2 =  $siteSetting->getColor2();
        $color3 =  $siteSetting->getColor3();

        $color1 = $color1[0]['color_hex'];
        $color2 = $color2[0]['color_hex'];
        $color3 = $color3[0]['color_hex'];

        //var_dump($color1,$color2,$color3);

       $this->_f3->set('color1', $color1);
       $this->_f3->set('color2', $color2);
       $this->_f3->set('color3', $color3);

    }

    /**
     * Uploads photo chosen by user if valid
     */
    public function uploadPhoto()
    {
        // Preconditions
        if (!$_SESSION["validUser"] || $_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_FILES['photo'])) {
            return;
        }

        $imageIn = $_FILES['photo'];
        $picPath = 'assets/img/' . basename($imageIn["name"]);
        $imageFileType = strtolower(pathinfo($picPath,PATHINFO_EXTENSION));

        // Upload validated photo
        if ((new Validator($this->_f3))->validPhoto($imageIn, $imageFileType, $picPath)) {

            if (move_uploaded_file($imageIn["tmp_name"], $picPath)) {

                //rename file to overwrite existing logo
                rename($picPath, "assets/img/logo.".$imageFileType);

                $this->_htmlContentDb->setContent("site", "logo", $imageFileType, 1);
                return;
            }
            echo 'There was an error uploading your file.';
        }
    }

    function addUser()
    {
        // Preconditions
        if (!$_SESSION["validUser"] || $_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $config = include("/home/nwagreen/config.php");
        $dbh = new PDO($config["db"], $config["username"], $config["password"]);

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $validator = new Validator($this->_f3);

        if (!$validator->validEmail($email)) {
            echo "Invalid Email Format";
            return;
        }

        if (!$validator->validPassword($password)) {
            echo "Invalid Password: Requires at least 1 Uppercase and 1 Number and have a length greater than 8";
            return;
        }

        if ($this->_htmlContentDb->emailDoesExist($email)) {
            echo "Error: This email already exists.";
            return;
        }

        if (!(new login($dbh))->addUser($email,$password)) {
            echo "Error: User could not be saved to database.";
        }
    }

    /**
     * Determines if the information being submitted when the user adds a new internship is valid, if so
     * then we add information to the database and route back the admin page.
     */
    public function addInternship()
    {

        $config = include("/home/nwagreen/config.php");
        $dbh = new PDO($config["db"], $config["username"], $config["password"]);


        $title = $_POST["title"];
        $company = $_POST["company"];
        $appTypeText = $_POST["appTypeText"];
        $description = $_POST["description"];
        $location = $_POST["location"];
        $category = $_POST["category"];
        $qualifications = $_POST["qualifications"];
        $errors = (new Validator($this->_f3))->validInternship();
        if(empty($errors)){
            (new addInternship($dbh))->addInternship($title, $company, $appTypeText, $description, $location, $category, $qualifications);
            return;
        }
        echo json_encode($errors);
    }
}
