<?php
// turn on some global settings
ini_set("display_errors", 1);
error_reporting(E_ALL);

//Require autoload file
require("vendor/autoload.php");

session_start();

// load the fat free framework
$fatFree = require 'vendor/bcosca/fatfree-core/base.php';

// Show errors for debugging
$fatFree->set('DEBUG', 3);

// fat free errors handling
$fatFree->set('ONERROR', function ($fatFree){
    echo $fatFree->get('ERROR.text');
});

$controller = new Controller($fatFree);

//define some routes
// main page
$fatFree->route('GET /', function ($fatFree){
    $GLOBALS['controller']->introduction($fatFree);
});

//internship page
$fatFree->route('GET /internships', function (){
    $GLOBALS['controller']->internship();
});

// resources page
$fatFree->route('GET /studentResources', function (){
    $GLOBALS['controller']->studentResources();
});

// admin login page
$fatFree->route('GET|POST /login', function (){
    $GLOBALS['controller']->login();
});

// admin page
$fatFree->route('GET|POST /adminPage', function ($fatFree){
    $GLOBALS['controller']->adminPage($fatFree);
});

// register admin page
$fatFree->route('GET|POST /register', function ($fatFree){
    $GLOBALS['controller']->register($fatFree);
});

$fatFree->route('GET|POST /upcoming-events', function($fatFree) {
    $GLOBALS['controller']->upcomingEvents($fatFree);
});

// logout admin page
$fatFree->route('POST /Logout', function (){
    $GLOBALS['controller']->logout();
});

$fatFree->route('POST /editHtmlContent', function (){
    $GLOBALS['controller']->editHtmlContent();
});

$fatFree->route('POST /setColor', function (){
    $GLOBALS['controller']->setColor();
});

$fatFree->route('POST /add_internships', function (){
    $GLOBALS['controller']->addInternship();
});

$fatFree->route('POST /uploadPhoto', function (){
    $GLOBALS['controller']->uploadPhoto();
});

$fatFree->route('POST /updateApiSource', function (){
    $GLOBALS['controller']->updateApiSource();
});

$fatFree->route('POST /addMeetupGroup', function (){
    $GLOBALS['controller']->addMeetupGroup();
});

$fatFree->route('POST /deleteMeetupGroup', function (){
    $GLOBALS['controller']->deleteMeetupGroup();
});

$fatFree->route('POST /addUser', function (){
    $GLOBALS['controller']->addUser();
});


//needed to run
$fatFree->run();

