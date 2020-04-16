<?php
/**
MIT License

Copyright (c) 2016 Michael Lant, Bogdan Pshonyak, Yegor Shemereko

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
 * Users api
 * Provides ajax with an api that returns different data according to the submit type from resources page
 */

//Session started to hold admin login data
session_start();

//DB connection files
include "../models/resourcesModel.php";
$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$resources = new ResourcesModel($db);

//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    // Retrieve resources body
    case "GET":

        $result = $resources->getBody();
        break;

    //Placeholder
    case "POST":

        $result = $_POST;
        break;

    // Update resources body
    case "PUT":

        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);

        if (isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] = "true")
        {
            $resources->updateBody($_PUT["body"]);
        }

        $result = $_PUT;
        break;

    //Placeholder
    case "DELETE":

        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $_DELETE;
        break;

}

header("Content-Type: application/json");
echo json_encode($result);
