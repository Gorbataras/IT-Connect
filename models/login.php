<?php

/**
 * Class UserModel - Interacts with the users table in the database
 */
class login
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
     * @param $username string Username to try
     * @param $password string Password to try
     * @return bool     True if credentials match the database
     */
    public function checkLogin($username, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        /*query databse for user and password*/
        $sql = "SELECT login_id FROM login WHERE email = :username AND password = :passwordHash";
        $q = $this->db->prepare($sql);

        $q->bindValue("username", $username);
        $q->bindValue("password", $passwordHash);
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
     * @param $email string user entered email
     * @param $password string user entered password
     * @return bool     True if credentials in the database
     */
    public function addUser($email, $password){

        // hash password
        $password = password_hash($password, PASSWORD_DEFAULT);
        /*insert into database*/
        $sql = "INSERT INTO login (email, password) VALUES (:email , :password)";
        $q = $this->db->prepare($sql);
        $q->bindValue("email",      $email);
        $q->bindValue("password",   $password);
        return $q->execute();
    }
}