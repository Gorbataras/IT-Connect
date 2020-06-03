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
        $htmlContentDb = new htmlContent();

        // Get internships, Meetup events, blog posts and HTML content
        $internships = (new PostingsModel())->getAllPostings();
        $meetupList = $this->getRecentMeetups($htmlContentDb, true);
        $blog = $this->getRecentBlogPosts($htmlContentDb);
        $content = $htmlContentDb->getAllPageContent('home');

        // Set to hive
        $this->_f3->set('array', $meetupList);
        $this->_f3->set('posts', $internships);
        $this->_f3->set('blog', $blog);
        $this->_f3->set('content', $content);

        echo Template::instance()->render('views/introduction.php');
    }


    /**
     * Retrieves the most recent blog posts from api and formats the data
     * @param $htmlContentDb db context
     * @return array 3 most recent blog posts
     */
    private function getRecentBlogPosts($htmlContentDb) {
        $row = $htmlContentDb->getApiSourceNamesByDomain(self::MEDIUM_DOMAIN);

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
        $htmlContentDb = new htmlContent();

        //Meetups Control
        if ($_REQUEST['source-tab'] == 'meetups') {
            $addedGroupName = $_POST['new-group'];
            $removedGroupname = $_POST['entry'];

            // Add or Delete meetup group
            switch ($_REQUEST['task']) {
                case 'add':
                    $this->addMeetupGroup($htmlContentDb, $addedGroupName);
                    break;
                case 'delete':
                    $this->meetupDelete($htmlContentDb, $removedGroupname);
                    break;
            }
        }

        // Get HTML content, blog source, Meetup Groups
        $homeContent = $htmlContentDb->getAllPageContent('home');
        $blogSourceName = $this->getBlogSourceName($htmlContentDb);
        $meetupGroupsList = $htmlContentDb->getApiSourceNamesByDomain(self::MEETUP_DOMAIN);

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


    /**
     * Gets the name of the of the blog source from the database or null if none
     * @param $htmlContentDb db context
     * @return mixed|null name of blog source
     */
    private function getBlogSourceName($htmlContentDb) {
        $row = $htmlContentDb->getApiSourceNamesByDomain(self::MEDIUM_DOMAIN);

        if (!empty($row)) {
            return $row[0]['source_name'];
        }
        return null;
    }


    /**
     * Add new Meetup group to Db
     * @param $htmlContentDb object db context
     * @param $groupName string name of group to add
     */
    private function addMeetupGroup($htmlContentDb, $groupName)
    {
    	//Create a URL
		$meetupLink = str_replace('placeholder', $_POST['new-group'], self::MEETUP_API_URL);

        //If the entry does not already exist, add to db
        if (!$htmlContentDb->apiSourceNameDoesExist(self::MEETUP_DOMAIN, $groupName) && $this->isValidUrl($meetupLink)) {
			$htmlContentDb->addApiSourceName(self::MEETUP_DOMAIN,$groupName);
			$this->_f3->unset('meetupSourceError');
		} else {
        	$this->_f3->set('meetupSourceError', "Invalid Group Source or Group already exists.");
		}
    }


    /**
     * Remove a Meetup group from JSON file
     * @param $groupName string name of group to delete
     * @param $htmlContentDb object db context
     */
    private function meetupDelete($htmlContentDb, $groupName)
    {
        // Delete existing group from the db
        if ($htmlContentDb->apiSourceNameDoesExist(self::MEETUP_DOMAIN, $groupName)) {
            $htmlContentDb->deleteApiSourceName(self::MEETUP_DOMAIN, $groupName);
        }
    }


    /**
     * Shows all upcoming Meetup events for saved meetup groups
     */
    function upcomingEvents()
    {
        $htmlContentDb = new htmlContent();
        $meetupList = $this->getRecentMeetups($htmlContentDb, false);

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
        $url = self::MEDIUM_API_URL . $blogSourceName;

        // Medium blog must be a valid url
        if (!$this->isValidUrl($url)) {
            echo "The submitted Medium source ($blogSourceName) does not work. No changes were saved.";
            return;
        }

        $htmlContentDb = new htmlContent();

        $status = "";

        // Save blog source name
        if (!$htmlContentDb->updateApiSourceNameByDomain(self::MEDIUM_DOMAIN, $blogSourceName)) {
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
     * @param $htmlContentDb db context
     * @param $hasLimit boolean true if only want to return 5 of most recent Meetup events
     * @return array Meetup event data
     */
    private function getRecentMeetups($htmlContentDb, $hasLimit)
    {
        //Retrieve list of sources
        $meetupGroupsList = $htmlContentDb->getApiSourceNamesByDomain(self::MEETUP_DOMAIN);

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