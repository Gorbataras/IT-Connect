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
 * 2020-5-7
 */

/*redirect to the introduction page*/
function introduction($fatFree){

    // show the introduction page
	//Meetup integration

	$meetupGroupsList = file_get_contents('db/meetupSources.json');
	$meetupGroupsList = json_decode($meetupGroupsList,1);
	$link = 'https://api.meetup.com/placeholder/events?&sign=true&photo-host=public';

	$meetupList = array();
	$counter = 0;
	foreach ($meetupGroupsList as $source) {
		$currSource = str_replace('placeholder', $source, $link);

		$response = file_get_contents($currSource);
		$response = json_decode($response,1);
		foreach ($response as $event) {

			array_push($meetupList, $event);
			$counter++;
			if ($counter == 5){
				break;
			}
		}
		if ($counter==5) {
			break;
		}
	}



	usort($meetupList, "sortFunction");
	$fatFree->set('array', $meetupList);


	//Internships integration
    $config = include("/home/nwagreen/config.php");
    $db = new PDO($config["db"], $config["username"], $config["password"]);
    $posts = new PostingsModel($db);
    $fatFree->set('posts', $posts->getAllPostings());
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

function adminPage($fatFree){
	$meetupGroupsList = file_get_contents('db/meetupSources.json');
	$meetupGroupsList = json_decode($meetupGroupsList, 1);
	$fatFree->set('meetupGroupsList', $meetupGroupsList);

	//Meetups Control
	if ($_REQUEST['source-tab'] == 'meetups') {
		switch($_REQUEST['task']){
			case 'add':
				meetupUpdate($meetupGroupsList, $fatFree);
				break;
			case 'delete':
				meetupDelete($meetupGroupsList, $fatFree);
				break;
		}
	}


	//if ($_SESSION["validUser"] == true){
	echo Template::instance()->render('views/adminPage.php');

	//    }else{
	//        /*redirect to admin Login*/
	//        header('Location: https://itconnect.greenrivertech.net/adminLogin');
	//        exit;
	//    }

}

function meetupUpdate($meetupGroupsList, $fatFree) {
	if( !in_array($_POST['new-group'], $meetupGroupsList) ) {
		array_push($meetupGroupsList,$_POST['new-group']);
		file_put_contents('db/meetupSources.json',
			json_encode($meetupGroupsList));
	}
	$meetupGroupsList = file_get_contents('db/meetupSources.json');
	$meetupGroupsList = json_decode($meetupGroupsList,1);
	$fatFree->set('meetupGroupsList', $meetupGroupsList);
}

function meetupDelete($meetupsGroupsList, $fatFree) {
	if (($key = array_search($_POST['entry'], $meetupsGroupsList)) !== false) {
		unset($meetupsGroupsList[$key]);
	}

	file_put_contents('db/meetupSources.json',
		json_encode($meetupsGroupsList));
	$meetupGroupsList = file_get_contents('db/meetupSources.json');
	$meetupGroupsList = json_decode($meetupGroupsList, 1);

	$fatFree->set('meetupGroupsList', $meetupGroupsList);
}

function logout(){
	//  Log out of page
    // destroy session
    session_destroy();

    // send to main page
   header('Location: https://itconnect.greenrivertech.net/adminLogin');
    exit;
}