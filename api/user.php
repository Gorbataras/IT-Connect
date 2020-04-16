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
 * Provides ajax with an api that returns different data according to the submit type from user modification page
 */

//Session holds admin login data
session_start();

include "../models/UserModel.php";

//Files to connect to the DB
$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$user = new UserModel($db);

//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    //Placeholder
    case "GET":

        $result = $_GET;
        break;

    // Attempt user login
    case "POST":

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = $user->checkLogin($username, $password);

        break;


        // add new user
    case "ADD":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_ADD);

        /*echo "INSIDE USER API";*/

        $email = $_ADD["addEmail"];


        if (isset($email))
        {
            $result = $user->addUser($email);

           /* echo 'print result in user.php';
            echo '<pre>';
            print_r($result);
            echo '</pre>';*/
        }

        break;







    // Update user password
    case "PUT":

        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);

        if (isset($_PUT["email"]))
        {
            $result = $user->resetPassword($_PUT["email"]);
        }
        else if (isset($_PUT["oldPassword"]) AND isset($_PUT["newPassword"]))
        {
            $id = $_SESSION['user_id'];
            $oldPassword = $_PUT["oldPassword"];
            $newPassword = $_PUT["newPassword"];
            $newPasswordCR = $_PUT["newPasswordCR"];

            if($newPassword == $newPasswordCR)
            {
                if (isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] = "true")
                {
                    $result = $user->changePassword($id, $oldPassword, $newPassword);
                }
            }
            else
            {
                $result = [false, "new password doesn't match new password confirm."];
            }

        }
        else
        {
            $result = false;
        }

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
