<?php
/**
MIT License
Copyright (c) 2018 Michael Lant, Bogdan Pshonyak, Yegor Shemereko, Abdalla M. Abdalla

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
 * Class UserModel - Interacts with the users table in the database
 */
class UserModel
{

// Fields
    protected $db;

// Constructor
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Validates user
     *
     * @param $username Username to try
     * @param $password Password to try
     * @return bool     True if credentials match the database
     */
    public function checkLogin($username, $password)
    {
        /*query databse for user and password*/
        $sql = "SELECT user_id FROM users WHERE email = :username AND password = SHA1(:password)";
        $q = $this->db->prepare($sql);
        $q->bindValue("username", $username, PDO::PARAM_STR);
        $q->bindValue("password", $password, PDO::PARAM_STR);
        $q->execute();
        $user_id = $q->fetchColumn();
        if ($user_id) {
            $_SESSION['loggedIn'] = "true";
            $_SESSION['user_id'] = $user_id;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Add new user
     *
     * @param $email user entered email
     * @return bool     True if credentials in the database
     */
    public function addUser($email){
        /*generate random password*/
        $password = $this->generatePassword();

        // hash password
        $password_hash = SHA1($password);
        /*insert into database*/
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password_hash')";
        $q = $this->db->prepare($sql);
        $q->bindValue("email",      $email,     PDO::PARAM_STR);
        $q->bindValue("password",   $password,  PDO::PARAM_STR);
        $q->execute();
        if($q)
        {
            $this->sendPassword($email, $password);
            return true;
        }
    }

    /**
     * Changes a users password
     *
     * @param $id           user_id vlaue
     * @param $oldPassword  Old password
     * @param $newPassword  New password
     * @return bool         True if password was changed
     */
    public function changePassword($id, $oldPassword,  $newPassword)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE user_id = :id AND password = SHA1(:password)";
        $q = $this->db->prepare($sql);
        $q->bindValue("id",         $id,            PDO::PARAM_STR);
        $q->bindValue("password",   $oldPassword,   PDO::PARAM_STR);
        $q->execute();
        $count = $q->fetchColumn();
        if ($count == 1) {
            $sql = "UPDATE users SET password = SHA1(:password) WHERE user_id = :id";
            $q = $this->db->prepare($sql);
            $q->bindValue("password",   $newPassword,   PDO::PARAM_STR);
            $q->bindValue("id",         $id,            PDO::PARAM_STR);
            $q->execute();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Resets user's password and send email with reset password
     *
     * @param $email    User's email
     * @return bool     True if password was reset
     */
    public function resetPassword($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $q = $this->db->prepare($sql);
        $q->bindValue("email", $email, PDO::PARAM_STR);
        $q->execute();
        $count = $q->fetchColumn();
        if ($count == 1)
        {
            $password = $this->generatePassword();
            $sql = "UPDATE users SET password = SHA1(:password) WHERE email = :email";
            $q = $this->db->prepare($sql);
            $q->bindValue("password",   $password,  PDO::PARAM_STR);
            $q->bindValue("email",      $email,     PDO::PARAM_STR);
            $q->execute();
            if($q)
            {
                $this->sendEmailWithPassword($email, $password);
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Generates random password
     *
     * @source              http://stackoverflow.com/questions/6101956/generating-a-random-password-in-php/31284266#31284266
     * @param int $length   Password character length
     * @return string       Generated Password
     */
    public function generatePassword($length = 8)
    {
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
            '0123456789';
        $str = '';
        $max = strlen($chars) - 1;
        for ($i=0; $i < $length; $i++)
            $str .= $chars[mt_rand(0, $max)];
        return $str;
    }

    /**
     * Sends new password and email to new user
     *
     * @param $email        Recipient's email
     * @param $password     New password
     */
    public function sendPassword($email, $password)
    {
        $to = $email;
        $subject = "IT Connect Password";
        $message = "
        <html>
            <head>
                <title>Welcome to ITConnect</title>
            </head>
         <body>
            <h2>Your IT Connect Password</h2>
            <p>hello $email, Your password is: $password</p>
            <p>Use this password to login to ITConnect.</p>
            <p>itconnect.greenrivertech.net/adminLogin</p>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <webmaster@itconnect.com>' . "\r\n";
        mail($to,$subject,$message,$headers);
    }

    /**
     * Sends reset password email
     *
     * @param $email        Recipient's email
     * @param $password     New password
     */
    public function sendEmailWithPassword($email, $password)
    {
        $to = $email;
        $subject = "IT Connect Password Reset";
        $message = "
        <html>
            <head>
            <title>Password Reset</title>
            </head>
        <body>
            <h2>IT Connect Password Reset Request</h2>
            <p>Your new password is: $password</p>
            <p>Please log into your account and change the password.</p>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <webmaster@itconnect.com>' . "\r\n";
        mail($to,$subject,$message,$headers);
    }
}