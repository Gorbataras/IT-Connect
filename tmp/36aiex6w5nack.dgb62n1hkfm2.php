<?php
require_once 'gatorLock/gatorlock.php';
require_once 'gatorLock/databaseConfig.php';
// if a cookie is set, then login already

$loginCode;

if (isset($_POST['logout'])){ //If the user has logged out
    $_Post['logout'] = null; // Set the logout variable equal to null so this isn't triggered falsely in the future
    forgetMe(); // remove cookie
}
if ((isset($_COOKIE[GL_UNCOOKIE_NAME]))){ // if the cookie exists
    $loginCode = glLoginWithCookie(); // Then use the cookie to login successfully
}

//If submit has been declared, and a cookie has not been set, then login as normal
if (isset($_POST['login'])){
    $_POST['login'] = null;

    $loginCode = gatorlockLogin($_POST['email-id'], $_POST['password-id']); //Login Normal

    switch ($loginCode) {
        case 0:
            // redirect to admin login page
            break;
        case 1:
            echo "<label class='text-center' style='font-size: 20px; color: red;'>Error: Not a green river email</label>";
            // big error
            break;
        case 7:
            // check to make sure user has access to this page
            $connection = getConnection();
            $email = mysqli_real_escape_string($connection, $_POST['email-id']);

            // if user is found in local database set session to true and redirect to page
            $userFound = getUsers($connection, $email);

            if ($userFound){
                $_SESSION["validUser"] = true;
                header("Location: adminPage"); /* Redirect browser */
                exit();
                break;
            }else{ // else show error
                echo "<label class='text-center' style='font-size: 20px; color: red;'>Error: User does not have access to this page</label>";
                break;
            }

        case 6:
            // username not found in the database
            echo "<label style='font-size: 20px; color: red;'>Error: Username or Password not found</label>";
            break;
        case 5:
            // wrong password
            echo "<label style='font-size: 20px; color: red;'>Error: Username or Password not found</label>";
            break;
        case 8:
            // too many login attempts
            echo "<label style='font-size: 20px; color: red;'>Error: Too many login attempts (5)</label>";
            break;
        case 15:
            // unverified gatorl lock account
            echo "<label style='font-size: 20px; color: red;'>Error: Account has been registered, but not yet verified by email</label>";
            break;
    }

    if ($loginCode == SUCCESSFUL_LOGIN){ //if the gatorLock function returns SUCCESSFUL_LOGIN
        if (isset($_POST['rememberme'])){ //If the user checked the box saying 'remeber me'
            rememberMe($_POST['email-id']); // Then set a cookie that contains the email address of the user
        }
    }

}