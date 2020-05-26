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
session_start();
/**
 * Main controller that redirects to different pages
 * @author Taras Gorbachevskiy
 * @author Chad Drennan
 * @author Marcos Rivera
 * 2020-5-7
 */

/*redirect to the introduction page*/
function introduction($fatFree){

    // Get recent Meetups
	$meetups = file_get_contents('https://api.meetup.com/South-King-Web-Mobile-Developers/events?&sign=true&photo-host=public');
	$meetups = json_decode($meetups);

    // Create PDO

	//Meetup integration

	//Retrieve list of sources
	$meetupGroupsList = file_get_contents('db/meetupSources.json');
	$meetupGroupsList = json_decode($meetupGroupsList,1);

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
		$response = json_decode($response,1);
		//Add each event from request to array
		foreach ($response as $event) {
			//add event to list
			array_push($meetupList, $event);
			$counter++;
			//Check for limit reached
			if ($counter == 5){
				break;
			}
		}
		//Check for limit reached
		if ($counter==5) {
			break;
		}
	}
	//Sort the entries using custom comparison function
	usort($meetupList, "sortFunction");

	//Internships integration
    $config = include("/home/nwagreen/config.php");
    $db = new PDO($config["db"], $config["username"], $config["password"]);

    // Get recent internships
    $internships = (new PostingsModel($db))->getAllPostings();

    // Get HTML content
    $content = (new htmlContent($db))->getAllPageContent('home');

    // Set to hive
    $fatFree->set('array', $meetupList);
    $fatFree->set('posts', $internships);
    $fatFree->set('content', $content);

    echo Template::instance()->render('views/introduction.php');
}

function sortFunction ($a, $b){
		return strtotime($a["local_date"]) - strtotime($b["local_date"]);
}



/*redirect to the internship page*/
function internship(){
    // show the internship page
    echo Template::instance()->render('views/internships.php');
}

/*redirect to the student resources page*/
function studentResources(){
    //  show the student resources page
    echo Template::instance()->render('views/studentResources.php');
}

function login(){
    //  show the admin Login page
    echo Template::instance()->render('gatorLock/login.php');
}

function register(){
    //  show the admin Login page
    echo Template::instance()->render('gatorLock/register.php');
}

/*
 * Shows all editable site content
 */
function adminPage($fatFree){

    //if ($_SESSION["validUser"] == true){

	//retrieve the json with list of sources
	$meetupGroupsList = file_get_contents('db/meetupSources.json');
	$meetupGroupsList = json_decode($meetupGroupsList, 1);
	$fatFree->set('meetupGroupsList', $meetupGroupsList);

	//Meetups Control
	if ($_REQUEST['source-tab'] == 'meetups') {
		//Decide what to do based on what user clicked
		switch($_REQUEST['task']){
			case 'add':
				//Add a new source
				meetupUpdate($meetupGroupsList, $fatFree);
				break;
			case 'delete':
				//Delete the selected entry from the sources list
				meetupDelete($meetupGroupsList, $fatFree);
				break;
		}
	}

    // Create PDO
    $config = include("/home/nwagreen/config.php");
    $db = new PDO($config["db"], $config["username"], $config["password"]);

    // Get HTML content
    $homeContent = (new htmlContent($db))->getAllPageContent('home');

    // Set to hive
    $fatFree->set('homeContent', $homeContent);

	echo Template::instance()->render('views/adminPage.php');

	//    }else{
	//        /*redirect to admin Login*/
	//        header('Location: https://itconnect.greenrivertech.net/adminLogin');
	//        exit;
	//    }

}


/*
 * Add new Meetup group to JSON file
 */
function meetupUpdate($meetupGroupsList, $fatFree) {
	//If the entry does not already exist
	if( !in_array($_POST['new-group'], $meetupGroupsList) ) {
		//Add entry to list
		array_push($meetupGroupsList,$_POST['new-group']);
		//Push the list to json file
		file_put_contents('db/meetupSources.json',
			json_encode($meetupGroupsList));
	}
	//Update the current sources displayed
	$meetupGroupsList = file_get_contents('db/meetupSources.json');
	$meetupGroupsList = json_decode($meetupGroupsList,1);
	$fatFree->set('meetupGroupsList', $meetupGroupsList);
}


/*
 * Remove a Meetup group from JSON file
 */
function meetupDelete($meetupsGroupsList, $fatFree) {
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
	$fatFree->set('meetupGroupsList', $meetupGroupsList);
}

/*
 * Shows all upcoming Meetup events for saved meetup groups
 */
function upcomingEvents($fatFree) {
	//Retrieve sources from json
	$meetupGroupsList = file_get_contents('db/meetupSources.json');
	$meetupGroupsList = json_decode($meetupGroupsList,1);

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
		$response = json_decode($response,1);
		//Add each array item to our meetup list
		foreach ($response as $event) { array_push($meetupList, $event); }

	}

	//Sort all entries by date using custom comparison function
	usort($meetupList, "sortFunction");
	//Add the list to fat free hive
	$fatFree->set('upcomingEvents', $meetupList);

	echo Template::instance()->render('views/upcomingEvents.php');
}

function logout(){
	//  Log out of page
    // destroy session
    session_destroy();

    // send to main page
   header('Location: https://itconnect.greenrivertech.net/adminLogin');
    exit;
}

/*
 * Receives and saves edited html content
 */
function editContent() {

    // Collect variables
    $page = $_POST['page'];
    $contentName = $_POST['contentName'];
    $html = $_POST['html'];
    $isShown = $_POST['isShown'] == 'true' ? 1 : 0;

    // Create PDO
    $config = include("/home/nwagreen/config.php");
    $db = new PDO($config["db"], $config["username"], $config["password"]);

    // Save HTML content
    echo (new htmlContent($db))->setContent($page, $contentName, $html, $isShown);
}