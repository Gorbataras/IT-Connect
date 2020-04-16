<?php
session_start();

//returns a new connection
function getConnection() {
    $user     = 'itconnec_putin';
    $pass     = 'boggybogbogz123!';
    $host     = 'localhost';
    $database = 'itconnec_kremlin';

    $connection = mysqli_connect($host, $user, $pass, $database);

    // if database does not connect
    if (!$connection) {
        echo ' Error Connecting to DB: ' . mysqli_connect_error();
        exit;
    }
    return $connection;
}

// add new users to database

function addUser($connection, $email) {

    if (isset($email)) {

        $query = "INSERT INTO users (email) VALUES ('$email')";

        $results = mysqli_query($connection, $query);

        if (!$results) {
            echo "<label style='font-size: 50px'>Database error: error could not enter information</label>";
        }
    }
    // Close the database connection.
    mysqli_close($connection);
}

// get users from database
function getUsers($connection, $email) {

    if (isset($email)) {

        $query = "SELECT email FROM users WHERE email = '$email'";

        $results = mysqli_query($connection, $query);

        $row = mysqli_num_rows($results);

        if ($row != 0){
        /*if ($results){*/
            $_SESSION['loggedIn'] = "true";
            $_SESSION["validUser"] = true;
            return true;
        } else {
            return false;
        }
    }
    // Close the database connection.
    mysqli_close($connection);
}