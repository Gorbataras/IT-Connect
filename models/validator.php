<?php

/* Performs validation for user submitted data
 *
 * File: validator.php
 * @author Chad Drennan
 * Date Created: 6/5/2020
 */

/**
 * Class Validator. Performs validation for user submitted data
 * @author Chad Drennan
 * Date Created: 6/5/2020
 */
class Validator
{
    // Fat-Free Framework Base object
    private $_f3;


    /**
     * Validation constructor.
     * @param $f3 object Base class instance for Fat-Free
     */
    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Ensures that a link works ie returns HTTP status in 200s
     * @param $url string URL to validate
     * @return bool true if link is valid ie HTTP status is in 200s
     */
    public function isValidUrl($url) {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        // Get the url content
        $response = curl_exec($handle);

        // Get the status code
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        // http status code must be in 200s
        if ($httpCode / 100 == 2) {
            return true;
        }
        return false;
    }


    /**
     * Validates if image is selected, limited to 500KB, and has a proper extension
     *
     * @param $imageIn - image to validate
     * @param $imageFileType - photo extension type
     * @param $picPath string path image is to be placed
     * @return bool - true if image meets all requirements
     *                false if image fails any case
     */
    public function validPhoto($imageIn, $imageFileType, $picPath) {

        if (empty($imageIn['tmp_name'])) {
            echo 'Error: No photo chosen.';
            return false;
        }

        // Check if image file is a actual image
        if (isset($_POST["photo-submit"]) && !getimagesize($imageIn["tmp_name"])) {
            echo 'Error: File is not an image. File was not uploaded.';
            return false;
        }

        // Check if file already exists
        if(substr($imageIn['name'], 0, strpos($imageIn['name'], '.')) != 'logo' AND file_exists($picPath)) {
            echo 'Error: File already exists. File was not uploaded' . $imageIn['name'];
            return false;
        }

        // Check file size
        if ($imageIn["size"] > 500000) {
            echo 'Error: File is too large. File was not uploaded';
            return false;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
            echo 'Error: Only JPG, JPEG, PNG & GIF files are allowed. File was not uploaded';
            return false;
        }
        return true;
    }

    /**
     * Validates the user email.
     *
     * @param $email string user entered email
     * @return bool
     */
    public function validEmail($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    /**
     * Validates the user password.
     *
     * @param $password string user entered password
     * @return bool
     */
    public function validPassword($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            return false;
        }
        return true;
    }
}