<?php

/* Performs database operations for editable html content of the site
 *
 * File: htmlContent.php
 * @author Chad Drennan
 * Date Created: 5/20/2020
 */


/**
 * The following class constructs a connection to the database to store the information attained from a new
 * internship. This information will be used to populate the table that showcases all available internships.
 * @author Marcos Rivera
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

    /**
     * The following method adds the parsed information into the database to be stored and referenced.
     * @param $title - Position title held
     * @param $company - Company name
     * @param $appTypeText - Either email or url for applying
     * @param $description - job description
     * @param $location - Area of work building or place to work at
     * @param $category - Software Development or Networking and Security
     * @param $qualifications - list of skills, knowledge, and experience needed to apply for internship
     */
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
