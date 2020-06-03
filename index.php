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
$fatFree->route('GET|POST /adminLogin', function (){
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
$fatFree->route('GET /Logout', function ($fatFree){
    $GLOBALS['controller']->logout($fatFree);
});

$fatFree->route('POST /editHomePage', function (){
    $GLOBALS['controller']->editHomePage();
});

$fatFree->route('POST /editHtmlContent', function (){
    $GLOBALS['controller']->editHtmlContent();
});

//needed to run
$fatFree->run();
?>
