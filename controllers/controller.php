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

    // Get recent Meetups
	$meetups = file_get_contents('https://api.meetup.com/South-King-Web-Mobile-Developers/events?&sign=true&photo-host=public');
	$meetups = json_decode($meetups);

    // Create PDO
    $config = include("/home/nwagreen/config.php");
    $db = new PDO($config["db"], $config["username"], $config["password"]);

    // Get recent internships
    $internships = (new PostingsModel($db))->getAllPostings();

    // Get HTML content
    $content = (new htmlContent($db))->getAllPageContent('home');

    // Set to hive
    $fatFree->set('array', $meetups);
    $fatFree->set('posts', $internships);
    $fatFree->set('content', $content);

    echo Template::instance()->render('views/introduction.php');
}

//function htmlContent($fatFree) {
//    // Create PDO
//    $config = include("/home/nwagreen/config.php");
//    $db = new PDO($config["db"], $config["username"], $config["password"]);
//
//    // Get HTML content
//    $content = (new htmlContent($db))->getAllPageContent('home');
//
//    echo $content;
//}

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

    //if ($_SESSION["validUser"] == true){

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

function logout(){
    //  Log out of page
    // destroy session
    session_destroy();

    // send to main page
   header('Location: https://itconnect.greenrivertech.net/adminLogin');
    exit;
}

function editContent() {
    $page = $_POST['page'];
    $contentName = $_POST['contentName'];
    $html = $_POST['html'];
    $isShown = $_POST['isShown'] ? 1 : 0;

    // Create PDO
    $config = include("/home/nwagreen/config.php");
    $db = new PDO($config["db"], $config["username"], $config["password"]);

    // Save HTML content
    (new htmlContent($db))->setContent($page, $contentName, $html, $isShown);

    echo true;
}