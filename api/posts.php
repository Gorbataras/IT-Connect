<?php
/**
 * MIT License
 *
 * Copyright (c) 2016 Michael Lant, Bogdan Pshonyak, Yegor Shemereko
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

/**
 * Posts api
 * Provides ajax with an api that returns different data according to the submit type from admin page
 */

//Session started to know if admin is logged in or not
session_start();

//Includes the postings model with all the function to deal w/ posts
include "../models/PostingsModel.php";

//Creating new posts object with DB specs
$postings = new PostingsModel();

//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    // Retrieve all internship posts
    case "GET":
        $result = $postings->getAllPostings();
        break;

    // Submit internship post
    case "POST":

        $title = $_POST["title"];
        $company = $_POST["company"];

        if ($_POST["Application_Type"] == "email") {
            $url = "";
            $email = $_POST["Application_Type_Text"];
        } else {
            $url = $_POST["Application_Type_Text"];
            $email = "";
        }

        $description = $_POST["description"];
        $location = $_POST["location"];
        $category = $_POST["category"];
        $qualifications = $_POST["qualifications"];
        $hours = $_POST["hours"];
        $id = $_POST["id"];

        //Initializing array to hold possible errors
        $error = array();

        $error = $postings->validatePost($id, $title, $company, $category, $location, $description, 0, $hours, $qualifications, $url, $email);

        //If error array has no errors then submit the post
        if (count($error) == 0) {
            if (isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] = "true") {
                $postings->submitPost($id, $title, $company, $category, $location, $description, 0, $hours, $qualifications, $url, $email);
            }
        }

        $result = $error;
        break;

    // Update internship post
    case "PUT":

        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);

        $title = $_PUT["title"];
        $company = $_PUT["company"];

        if ($_PUT["Application_Type"] == "email") {
            $url = "";
            $email = $_PUT["Application_Type_Text"];
        } else {
            $url = $_PUT["Application_Type_Text"];
            $email = "";
        }

        $description = $_PUT["description"];
        $location = $_PUT["location"];
        $category = $_PUT["category"];
        $qualifications = $_PUT["qualifications"];
        $hours = $_PUT["hours"];
        $id = $_PUT["id"];

        //If admin is logged in then update
        if (isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] = "true") {
            $postings->updatePost($id, $title, $company, $category, $location, $description, 0, $hours, $qualifications, $url, $email);
        }

        $result = $_PUT;

        break;

    // Delete internship post
    case "DELETE":

        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_DELETE);

        $id = $_DELETE["id"];

        if (isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] = "true") {
            $postings->deletePost($id);
        }

        $result = $_DELETE;

        break;

}

header("Content-Type: application/json");
echo json_encode($result);
