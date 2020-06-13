<?php

/* Performs database operations for editable html content of the site
 *
 * File: htmlContent.php
 * @author Chad Drennan
 * Date Created: 5/20/2020
 */


/**

 */
class addInternship
{
    // db connection
    private $_dbh;


    /**
     * htmlContent constructor.
     */
    public function __construct(PDO $dbh)
    {
        $this->_dbh = $dbh;
    }

    public function addInternship($title, $company, $appTypeText, $description, $location, $category, $qualifications) {

        $sql = "INSERT INTO `postings`(`company`, `url`, `title`, `description`, `location`, `category`, `qualifications`) VALUES (:company, :appTypeText, :title, :description, :location, :category, :qualifications)";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':company', $company);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':location', $location);
        $statement->bindParam(':appTypeText', $appTypeText);
        $statement->bindParam(':category', $category);
        $statement->bindParam(':qualifications', $qualifications);

        $statement->execute();
    }
}
