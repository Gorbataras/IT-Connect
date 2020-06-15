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
     * @param $hours - number of hours per week to work
     * @param $description - job description
     * @param $location - Area of work building or place to work at
     * @param $category - Software Development or Networking and Security
     * @param $url - URL of job posting
     * @param $email - email of where to apply
     * @param $qualifications - list of skills, knowledge, and experience needed to apply for internship
     */
    public function addInternship($title, $company, $description, $hours, $location, $category, $qualifications, $url,
                                  $email) {

        $sql = "INSERT INTO `postings`(`company`, `url`, `title`, `description`, `hours_per_week`, `location`, `category`
                    , `qualifications`, `email`) 
                VALUES (:company, :url, :title, :description, :hours, :location, :category
                    , :qualifications, :email)";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':company', $company);
        $statement->bindParam(':title', $title);

        if (empty($description)){
            $description = null;
        }
        $statement->bindParam(':description', $description);

        if (empty($hours)){
            $hours = null;
        }
        $statement->bindParam(':hours', $hours);

        $statement->bindParam(':location', $location);

        if (empty($url)){
            $url = null;
        }
        $statement->bindParam(':url', $url);


        if (empty($email)){
            $email = null;
        }
        $statement->bindParam(':email', $email);

        $statement->bindParam(':category', $category);

        if (empty($qualifications)){
            $qualifications = null;
        }
        $statement->bindParam(':qualifications', $qualifications);

        $statement->execute();
    }
}
