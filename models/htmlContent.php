<?php


/**
 * Class htmlContent. Performs database operations for editable html content of the site
 * @author Chad Drennan
 * Date Created: 5/20/2020
 */
class htmlContent
{
    // db connection
    private $_dbh;


    public function __construct(PDO $dbh)
    {
        $this->_dbh = $dbh;
    }

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