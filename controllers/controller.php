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
    const BLOG_POST_QTY = 3;

    // Base instance for Fat-Free Framework
    private $_f3;

    /**
     * Controller constructor.
     * @param $f3 Fat-Free Base object
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


    /**
     * Redirect to the introduction page
     */
    function introduction()
    {
        // Create PDO
        $config = include("/home/nwagreen/config.php");
        $db = new PDO($config["db"], $config["username"], $config["password"]);

        $htmlContent = new htmlContent($db);

        // Get internships, Meetup events, blog posts and HTML content
        $internships = (new PostingsModel($db))->getAllPostings();
        $meetupList = $this->getRecentMeetups();
        $blog = $this->getRecentBlogPosts($htmlContent);
        $content = $htmlContent->getAllPageContent('home');

        // Set to hive
        $this->_f3->set('array', $meetupList);
        $this->_f3->set('posts', $internships);
        $this->_f3->set('blog', $blog);
        $this->_f3->set('content', $content);

        echo Template::instance()->render('views/introduction.php');
    }


    /**
     * Retrieves the most recent blog posts from api and formats the data
     * @param $htmlContent
     * @return array 3 most recent blog posts
     */
    private function getRecentBlogPosts($htmlContent) {
        $row = $htmlContent->getApiSourceNamesByDomain('medium.com');

        $srcName = '';
        if (empty($row) || empty($row[0]['source_name'])) {
            return null;
        }
        else {
            $srcName = $row[0]['source_name'];
        }

        // Retrieve Medium JSON query results from Medium RSS feed
        $result = json_decode(file_get_contents('https://api.rss2json.com/v1/api.json?rss_url='
                . 'https://medium.com/feed/' . $srcName), true);

        // Separate posts from comments, take only 3 posts
        $posts = [];
        $count = 0;

        // Format and take 3 most recent
        foreach ($result['items'] as $currPost) {

            // Separate posts from comments
            if (!empty($currPost['categories'])) {

                // Get first paragraph and cap its length
                $doc = new DOMDocument();

                // @ to suppress irrelevant error caused by data
                @$doc->loadHTML($currPost['content']);
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

        // Create PDO
        $config = include("/home/nwagreen/config.php");
        $db = new PDO($config["db"], $config["username"], $config["password"]);

        //retrieve the json with list of sources
        $meetupGroupsList = file_get_contents('db/meetupSources.json');
        $meetupGroupsList = json_decode($meetupGroupsList, 1);

        //Meetups Control
        if ($_REQUEST['source-tab'] == 'meetups') {
            //Decide what to do based on what user clicked
            switch ($_REQUEST['task']) {
                case 'add':
                    //Add a new source
                    $this->meetupUpdate($meetupGroupsList);
                    break;
                case 'delete':
                    //Delete the selected entry from the sources list
                    $this->meetupDelete($meetupGroupsList);
                    break;
            }
        }

        $htmlContent = new htmlContent($db);

        // Get HTML content, blog source
        $homeContent = $htmlContent->getAllPageContent('home');
        $blogSourceName = $this->getBlogSourceName($htmlContent);

        // Set to hive
        $this->_f3->set('homeContent', $homeContent);
        $this->_f3->set('blogSourceName', $blogSourceName);
        $this->_f3->set('meetupGroupsList', $meetupGroupsList);

        echo Template::instance()->render('views/adminPage.php');

        //    }else{
        //        /*redirect to admin Login*/
        //        header('Location: https://itconnect.greenrivertech.net/adminLogin');
        //        exit;
        //    }

    }

    private function getBlogSourceName($htmlContent) {
        $row = $htmlContent->getApiSourceNamesByDomain('medium.com');

        if (!empty($row)) {
            return $row[0]['source_name'];
        }
        return null;
    }


    /**
     * Add new Meetup group to JSON file
     */
    private function meetupUpdate($meetupGroupsList)
    {
        //If the entry does not already exist
        if (!in_array($_POST['new-group'], $meetupGroupsList)) {
            //Add entry to list
            array_push($meetupGroupsList, $_POST['new-group']);
            //Push the list to json file
            file_put_contents('db/meetupSources.json',
                json_encode($meetupGroupsList));
        }
        //Update the current sources displayed
        $meetupGroupsList = file_get_contents('db/meetupSources.json');
        $meetupGroupsList = json_decode($meetupGroupsList, 1);
        $this->_f3->set('meetupGroupsList', $meetupGroupsList);
    }


    /**
     * Remove a Meetup group from JSON file
     */
    private function meetupDelete($meetupsGroupsList)
    {
        //Find the requested source in the list
        if (($key = array_search($_POST['entry'], $meetupsGroupsList)) !== false) {
            //Remove the source from the array
            unset($meetupsGroupsList[$key]);
        }

        //Write the changes to json
        file_put_contents('db/meetupSources.json',
            json_encode($meetupsGroupsList));
        //Update the current sources displayed
        $meetupGroupsList = file_get_contents('db/meetupSources.json');
        $meetupGroupsList = json_decode($meetupGroupsList, 1);
        $this->_f3->set('meetupGroupsList', $meetupGroupsList);
    }


    /**
     * Shows all upcoming Meetup events for saved meetup groups
     */
    function upcomingEvents()
    {
        //Retrieve sources from json
        $meetupGroupsList = file_get_contents('db/meetupSources.json');
        $meetupGroupsList = json_decode($meetupGroupsList, 1);

        //Link to be manipulated. "placeholder" will be replaced multiple times in order to do
        //multiple requests
        $link = 'https://api.meetup.com/placeholder/events?&sign=true&photo-host=public';

        //Store single events
        $meetupList = array();

        //Loop through sources
        foreach ($meetupGroupsList as $source) {
            //Create link to be requested from the meetup api
            $currSource = str_replace('placeholder', $source, $link);

            //Request to meetup api
            $response = file_get_contents($currSource);
            $response = json_decode($response, 1);
            //Add each array item to our meetup list
            foreach ($response as $event) {
                array_push($meetupList, $event);
            }

        }

        //Sort all entries by date using custom comparison function
        usort($meetupList, ["Controller", "sortFunction"]);
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


    /**
     * Receives and saves edited html content
     */
    function editContent()
    {
        $blogSourceName = trim($_POST['blogSourceName']);
        $url = 'https://medium.com/' . $blogSourceName;

        // Medium blog must be a valid url
        if (!$this->isValidUrl($url)) {
            echo "The submitted Medium link ($url) does not work. No changes were saved.";
            return;
        }

        // Create PDO
        $config = include("/home/nwagreen/config.php");
        $db = new PDO($config["db"], $config["username"], $config["password"]);
        $htmlContentDb = new htmlContent($db);

        $status = "";

        // Save blog source name
        if (!$htmlContentDb->updateApiSourceNameByDomain('medium.com', $blogSourceName)) {
            $status .= 'Error: "' .  str_replace('-', ' ', $blogSourceName) . '" was not saved.';
        }

        // Save htmlContent
        foreach ($_POST['htmlContent'] as $contentItem) {

            // Collect variables
            $page = $contentItem['page'];
            $contentName = $contentItem['contentName'];
            $html = $contentItem['html'];
            $isShown = $contentItem['isShown'] == 'true' ? 1 : 0;

            // Save HTML content
            if (!$htmlContentDb->setContent($page, $contentName, $html, $isShown)) {
                $status .= 'Error: "' .  str_replace('-', ' ', $contentName) . '" was not saved.';
            }
        }
        echo $status;
    }

    private function isValidUrl($url) {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
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
     * @return array Meetup event data
     */
    private function getRecentMeetups()
    {
        //Retrieve list of sources
        $meetupGroupsList = file_get_contents('db/meetupSources.json');
        $meetupGroupsList = json_decode($meetupGroupsList, 1);

        //link to be manipulated. "placeholder" will be replaced repeatedly with each entry
        //in the list
        $link = 'https://api.meetup.com/placeholder/events?&sign=true&photo-host=public';

        //Store meetups
        $meetupList = array();
        //limit 5
        $counter = 0;

        // Send request for each source
        foreach ($meetupGroupsList as $source) {
            // make link for the current source
            $currSource = str_replace('placeholder', $source, $link);

            //Make request to meetup api
            $response = file_get_contents($currSource);
            $response = json_decode($response, 1);
            //Add each event from request to array
            foreach ($response as $event) {
                //add event to list
                array_push($meetupList, $event);
                $counter++;
                //Check for limit reached
                if ($counter == 5) {
                    break;
                }
            }
            //Check for limit reached
            if ($counter == 5) {
                break;
            }
        }
        //Sort the entries using custom comparison function
        usort($meetupList, ["Controller", "sortFunction"]);
        return $meetupList;
    }
}