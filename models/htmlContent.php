<?php

/* Performs database operations for editable html content of the site
 *
 * File: htmlContent.php
 * @author Chad Drennan
 * Date Created: 5/20/2020
 */


/**
 * Class htmlContent. Performs database operations for editable html content of the site
 * @author Chad Drennan
 * Date Created: 5/20/2020
 */
class htmlContent
{
    // db connection
    private $_dbh;


    /**
     * htmlContent constructor.
     */
    public function __construct()
    {
        // Create PDO
        $config = include("/home/nwagreen/config.php");
        $dbh = new PDO($config["db"], $config["username"], $config["password"]);

        $this->_dbh = $dbh;
    }


    /**
     * Retrieves html content by page name and content name
     * @param $pageName string name of the page the content belongs to
     * @param $contentName string name of the content ex. 'introduction'
     * @return array the matching row if any
     */
    public function getContent($pageName, $contentName)
    {
        $sql = "SELECT content_name, html, is_shown
                FROM html_content
                WHERE page_name = :pageName AND  content_name = :contentName";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':pageName', $pageName);
        $statement->bindParam(':contentName', $contentName);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Retrieves all html content for a page. Key of the array result is the content name
     * @param $pageName string name of page content belongs to
     * @return array result of query. Key of array is content name
     */
    public function getAllPageContent($pageName)
    {
        $sql = "SELECT content_name, html, is_shown
                FROM html_content
                WHERE page_name = :pageName";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':pageName', $pageName);

        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        // Create array with content name as the key
        foreach ($rows as $currRow) {
            $result[$currRow['content_name']] = ['html' => $currRow['html'], 'isShown' => $currRow['is_shown']];
        }
        return $result;
    }


    /**
     * Updates html content to the html_content table
     * @param $pageName string name of page the content belongs to
     * @param $contentName string name of the content ex introduction
     * @param $html string html of content
     * @param $isShown int 1 indicates html is to be shown. 0 indicates to hide content
     * @return true if query did not fail
     */
    public function setContent($pageName, $contentName, $html, $isShown) {
        $sql = "UPDATE html_content
                SET html = :html, is_shown = :isShown
                WHERE page_name = :pageName AND content_name = :contentName";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindValue(':html', $html);
        $statement->bindValue(':isShown', $isShown);
        $statement->bindValue(':pageName', $pageName);
        $statement->bindValue(':contentName', $contentName);

        return $statement->execute();
    }


    /**
     * Gets the API source names from the db with matching domain
     * @param $domain string source of the API content
     * @return array of source names
     */
    public function getApiSourceNamesByDomain($domain) {
        $sql = "SELECT source_name
                FROM api_resource
                WHERE domain = :domain";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':domain', $domain);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Updates API source name
     * @param $domain string source of the API content
     * @param $sourceName string source of the API content
     * @return bool
     */
    public function updateApiSourceNameByDomain($domain, $sourceName) {
        $sql = "UPDATE api_resource
                SET source_name = :sourceName
                WHERE domain = :domain
                LIMIT 1";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindValue(':domain', $domain);
        $statement->bindValue(':sourceName', $sourceName);

        return $statement->execute();
    }


    /**
     * Adds API source name to the database
     * @param $domain string source of the API content
     * @param $sourceName string source of the API content
     * @return boolean true if insert was successful
     */
    public function addApiSourceName($domain, $sourceName) {
        $sql = "INSERT INTO api_resource (domain, source_name)
                VALUES (:domain, :sourceName)";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':domain', $domain);
        $statement->bindParam(':sourceName', $sourceName);

        return $statement->execute();
    }


    /**
     * Checks if API source exists in the database
     * @param $domain C
     * @param $sourceName string source of the API content
     * @return bool true if API source exists in the db
     */
    public function apiSourceNameDoesExist($domain, $sourceName) {
        $sql = "SELECT EXISTS(
                    SELECT api_resource_id
                    FROM api_resource
                    WHERE domain = :domain AND source_name = :sourceName)";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':domain', $domain);
        $statement->bindParam(':sourceName', $sourceName);

        $statement->execute();
        return $statement->fetch()[0] == 1 ? true : false;
    }


    /**
     * Checks if email exists in login table
     * @param $email email to check if exists
     * @return bool true if is found
     */
    public function emailDoesExist($email) {
        $sql = "SELECT EXISTS(
                    SELECT login_id
                    FROM login
                    WHERE email = :email)";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':email', $email);

        $statement->execute();
        return $statement->fetch()[0] == 1 ? true : false;
    }


    /**
     * Deletes API source name from db
     * @param $domain string domain of website the API belongs to
     * @param $sourceName string source of the API content
     * @return boolean true if delete was successful
     */
    public function deleteApiSourceName($domain, $sourceName) {
        $sql = 'DELETE FROM api_resource
                WHERE domain = :domain AND source_name = :sourceName';

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':domain', $domain);
        $statement->bindParam(':sourceName', $sourceName);

        return $statement->execute();
    }
}