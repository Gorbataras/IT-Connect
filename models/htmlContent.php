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
     * @param PDO $dbh database connection object
     */
    public function __construct(PDO $dbh)
    {
        $this->_dbh = $dbh;
    }


    /**
     * Retrieves html content by page name and content name
     * @param $pageName string name of the page the content belongs to
     * @param $contentName sting name of the content ex. 'introduction'
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

        $statement->execute();
    }
}