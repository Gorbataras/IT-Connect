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

        // If a site title is returned set to hive
        if ($result = $this->_htmlContentDb->getContent('header', 'title')) {
            $f3->set('siteTitle', $result[0]['html']);

            // Remove HTML tags and '$nbsp;' for site tab title
            $f3->set('siteTabTitle', str_replace('&nbsp;', '', strip_tags($result[0]['html'])));
        }
    }


    /**
     * Redirect to the introduction page
     */
    function introduction()
    {
        // Get internships, Meetup events, blog posts and HTML content

        $internships = (new PostingsModel())->getAllPostings();
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
        if (!$this->isValidUrl($url)) {
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
        //  show the admin Login page
        echo Template::instance()->render('gatorLock/login.php');
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
        //if ($_SESSION["validUser"] == true){

        //Meetups Control
        if ($_REQUEST['source-tab'] == 'meetups') {
            $addedGroupName = $_POST['new-group'];
            $removedGroupname = $_POST['entry'];

            // Add or Delete meetup group
            switch ($_REQUEST['task']) {
                case 'add':
                    $this->addMeetupGroup($addedGroupName);
                    break;
                case 'delete':
                    $this->meetupDelete($removedGroupname);
                    break;
            }
        }

        // Get HTML content, blog source, Meetup Groups
        $homeContent = $this->_htmlContentDb->getAllPageContent('home');
        $resourcesContent = $this->_htmlContentDb->getAllPageContent('resources');

        $blogSourceName = $this->getBlogSourceName();
        $meetupGroupsList = $this->_htmlContentDb->getApiSourceNamesByDomain(self::MEETUP_DOMAIN);

        // Set to hive
        $this->_f3->set('homeContent', $homeContent);
        $this->_f3->set('resourcesContent', $resourcesContent);
        $this->_f3->set('blogSourceName', $blogSourceName);
        $this->_f3->set('meetupGroupsList', $meetupGroupsList);

        echo Template::instance()->render('views/adminPage.php');

        //    }else{
        //        /*redirect to admin Login*/
        //        header('Location: https://itconnect.greenrivertech.net/adminLogin');
        //        exit;
        //    }

    }


    /**
     * Gets the name of the of the blog source from the database or null if none
     * @return mixed|null name of blog source
     */
    private function getBlogSourceName() {
        $row = $this->_htmlContentDb->getApiSourceNamesByDomain(self::MEDIUM_DOMAIN);

        if (!empty($row)) {
            return $row[0]['source_name'];
        }
        return null;
    }


    /**
     * Add new Meetup group to Db
     * @param $groupName string name of group to add
     */
    private function addMeetupGroup($groupName)
    {
        $newGroup = $_POST['new-group'];
        //Create a URL
        $meetupLink = str_replace('placeholder', $newGroup, self::MEETUP_API_URL);

        //If the entry does not already exist, add to db
        if (!$this->_htmlContentDb->apiSourceNameDoesExist(self::MEETUP_DOMAIN, $groupName) && $this->isValidUrl($meetupLink)) {
            $this->_htmlContentDb->addApiSourceName(self::MEETUP_DOMAIN,$groupName);
            $this->_f3->clear('meetupSourceError');
        } else {
            $this->_f3->set("meetupSourceError", "The following group name is either invalid or already is added: $newGroup");
        }
    }


    /**
     * Remove a Meetup group from JSON file
     * @param $groupName string name of group to delete
     */
    private function meetupDelete($groupName)
    {
        // Delete existing group from the db
        if ($this->_htmlContentDb->apiSourceNameDoesExist(self::MEETUP_DOMAIN, $groupName)) {
            $this->_htmlContentDb->deleteApiSourceName(self::MEETUP_DOMAIN, $groupName);
        }
    }


    /**
     * Shows all upcoming Meetup events for saved meetup groups
     */
    function upcomingEvents()
    {
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
        //  Log out of page
        // destroy session
        session_destroy();

        // send to main page
        header('Location: https://itconnect.greenrivertech.net/adminLogin');
        exit;
    }


    function editHtmlContent() {
//        //if ($_SESSION["validUser"] == true){
//        {
        echo $this->editHtmlContentHelper($_POST['htmlContent']);
//        }
    }


    /**
     * Receives and saves edited html content
     */
    function editHomePage()
    {
//if (!$_SESSION["validUser"] == true){
//        {
//            return;
//        }

        $blogSourceName = trim($_POST['blogSourceName']);
        $htmlItems = $_POST['htmlItems'];

        // Test first part of api url with source name
        $url = self::MEDIUM_API_URL . $blogSourceName;

        // Medium blog must be a valid url
        if (!$this->isValidUrl($url)) {
            echo "The submitted Medium source ($blogSourceName) does not work. No changes were saved.";
            return;
        }

        $status = "";

        // Save blog source name
        if (!$this->_htmlContentDb->updateApiSourceNameByDomain(self::MEDIUM_DOMAIN, $blogSourceName)) {
            $status .= 'Error: "' .  str_replace('-', ' ', $blogSourceName) . '" was not saved.';
        }

        // Save all htmlContent
        foreach ($htmlItems as $contentItem) {
            $status .= $this->editHtmlContentHelper($contentItem);
        }

        echo $status;
    }


    private function editHtmlContentHelper($contentItem) {

        // Collect variables
        $page = $contentItem['page'];
        $contentName = $contentItem['contentName'];
        $html = $contentItem['html'];
        $isShown = $contentItem['isShown'] == 'true' ? 1 : 0;

        // Save HTML content
        if (!$this->_htmlContentDb->setContent($page, $contentName, $html, $isShown)) {
            return 'Error: "' .  str_replace('-', ' ', $contentName) . '" was not saved.';
        }
        return '';
    }


    /**
     * Ensures that a link works ie returns HTTP status in 200s
     * @param $url string URL to validate
     * @return bool true if link is valid ie HTTP status is in 200s
     */
    private function isValidUrl($url) {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        // Get the url content
        $response = curl_exec($handle);

        // Get the status code
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        // http status code must be in 200s
        if ($httpCode / 100 == 2) {
            return true;
        }
        return false;
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
            if (!$this->isValidUrl($currSource)) {
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
}