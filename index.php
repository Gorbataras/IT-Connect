<?php
// turn on some global settings
ini_set("display_errors", 1);
error_reporting(E_ALL);

//global includes
require 'controllers/controller.php';

//Require autoload file
require("vendor/autoload.php");

// load the fat free framework
$fatFree = require 'vendor/bcosca/fatfree-core/base.php';

// fat free errors handling
$fatFree->set('ONERROR', function ($fatFree){
    echo $fatFree->get('ERROR.text');
});

//define some routes
// main page
$fatFree->route('GET /', function ($fatFree){
    introduction($fatFree);
});

//internship page
$fatFree->route('GET /internships', function (){
    internship();
});

// resources page
$fatFree->route('GET /studentResources', function (){
    studentResources();
});

// admin login page
$fatFree->route('GET|POST /adminLogin', function (){
    login();
});

// admin page
$fatFree->route('GET|POST /adminPage', function ($fatFree){
    adminPage($fatFree);
});

// register admin page
$fatFree->route('GET|POST /register', function ($fatFree){
    register($fatFree);
});

$fatFree->route('GET|POST /upcoming-events', function($fatFree) {
    upcomingEvents($fatFree);
});

// logout admin page
$fatFree->route('GET /Logout', function ($fatFree){
    logout($fatFree);
});

$fatFree->route('POST /editContent', function (){
    editContent();
});

//$fatFree->route('GET /htmlContent', function($fatFree) {
//    htmlContent($fatFree);
//});

//needed to run
$fatFree->run();
?>
