<?php

/*implementation of the register function*/
require_once 'gatorLock/gatorlock.php';
require_once 'gatorLock/databaseConfig.php';


if (isset($_POST['register'])){

    $result = gatorlockRegister($_POST['email-id'],$_POST['password-id'], $_POST['firstName-id'], $_POST['lastName-id']);

    $_POST['register'] = null;

    $connection = getConnection();
    $email = mysqli_real_escape_string($connection, $_POST['email-id']);

    switch ($result){
        case 0:
            // add user to local database
            addUser($connection, $email);
            // redirect to admin login page
            header("Location: adminLogin");
            exit();
            break;
        case 1:
            // show error. Not a Green River email
            echo "<label style='font-size: 20px; color: red;'>Error: Not a green river email</label>";
            break;
        case 2:
            // show error. does not meet password requirements
            echo "<label style='font-size: 20px; color: red;'>Error: Given password does not meet the requirements mentioned</label>";
            echo "<label style='font-size: 15px; color: red;'>1. The password must have at least 8 characters </label>";
            echo "<label style='font-size: 15px; color: red;'>2. The password must contain at least one letter. (Not case-sensitive) </label>";
            echo "<label style='font-size: 15px; color: red;'>3. The password must contain at least one number. </label>";
            echo "<label style='font-size: 15px; color: red;'>4. The password must contain at least one special character. </label>";
            break;
        case 3:
            // show error. Green River email already exists
            // Add new user to local database
            addUser($connection, $email);
            echo "<label style='font-size: 15px; color: red;'>New user already has a GatorLock Account. </label>";
            echo "<br>";
            echo "<label style='font-size: 30px; color: green;'>New User has been added as a valid user.</label>";
            exit();
            break;
    }
}
