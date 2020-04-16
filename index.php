<?php
// turn on some global settings
error_reporting(E_ALL);

//global includes
require 'controllers/controller.php';

// load the fat free framework
$fatFree = require 'vendor/bcosca/fatfree-core/base.php';

// fat free errors handling
$fatFree->set('ONERROR', function ($fatFree){
    echo $fatFree->get('ERROR.text');
});

//define some routes
// main page
$fatFree->route('GET /', function (){
    introduction();
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
$fatFree->route('GET|POST /adminPage', function (){
    adminPage();
});

// register admin page
$fatFree->route('GET|POST /register', function ($fatFree){
    register($fatFree);
});

// logout admin page
$fatFree->route('GET /Logout', function ($fatFree){
    logout($fatFree);
});

//needed to run
$fatFree->run();
?>