<?php
/**
MIT License

Copyright (c) 2016 Michael Lant, Bogdan Pshonyak, Yegor Shemereko

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

require "Post.php";

/**
 * Class PostingsModel - Interacts with the postings table in the database
 */
class PostingsModel
{

    // Fields
    protected $db;

    // Constructor
    public function __construct()
    {
        // Create PDO
        $config = include("/home/nwagreen/config.php");
        $db = new PDO($config["db"], $config["username"], $config["password"]);

        $this->db = $db;
    }

    /**
     * Retrieves all posts from the postings table
     *
     * @return array Array of post objects
     */
    public function getSamplePostings()
    {
        $sql = "SELECT * FROM postings WHERE deleted = false ORDER BY post_id DESC LIMIT 3";
        $q = $this->db->prepare($sql);
        $q->execute();
        $rows = $q->fetchALL();

        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

    /**
     * Retrieves all posts from the postings table
     *
     * @return array Array of post objects
     */
    public function getAllPostings()
    {
        $sql = "SELECT * FROM postings WHERE deleted = false ORDER BY post_id DESC";
        $q = $this->db->prepare($sql);
        $q->execute();
        $rows = $q->fetchALL();

        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

    /**
     * Reads post data from a SQL table row
     *
     * @param $row  SQL table row
     * @return Post Instance of post class
     */
    private function read($row)
    {



        // Format date
        $date = new DateTime($row["post_date"]);
        //$formatted_date = $date->format('m/d/Y');

        $formatted_date = $date->format('F d, Y');
        /*update format for date*/
        $formatted_Primary_date = $date->format("Y-m-d");


        $result = new Post();
        $result->post_id = $row["post_id"];
        $result->title = $row["title"];
        $result->url = $row["url"];
        $result->email = $row["email"];
        $result->deleted = $row["deleted"];
        $result->company = $row["company"];
        $result->category = $row["category"];
        $result->location = $row["location"];
        $result->description = $row['description'];
        $result->hours = $row["hours_per_week"];
        $result->qualifications = $row["qualifications"];
        $result->post_date = $formatted_date;

        $result->post_date_primary = $formatted_Primary_date;

        return $result;
    }

    /**
     * Retrieves a single post from the postings table
     *
     * @param $id       post_id of desired post
     * @return Post     Instance of the post class
     */
    public function getPost($id)
    {
        $sql = "SELECT * FROM postings WHERE post_id = :id AND deleted = false";
        $q = $this->db->prepare($sql);
        $q->bindValue("id", $id, PDO::PARAM_STR);

        $q->execute();
        $row = $q->fetch();

        $result = $this->read($row);

        return $result;
    }

    /**
     * Validates all data, except for $id, $paid, and $hours
     *
     * @param $id               post_id value
     * @param $title            Post title
     * @param $company          Company name
     * @param $category         Post category
     * @param $location         Company location
     * @param $description      Post description
     * @param $paid             True if internship is paid
     * @param $hours            Hours of work per week
     * @param $qualifications   Internship qualifications
     * @param $url              Original post link
     * @param $email            Contact email
     * @return Post             Instance of the post class
     */
    public function validatePost($id, $title, $company, $category, $location, $description, $paid, $hours, $qualifications, $url, $email)
    {
        $post = $this->createPost($id, $title, $company, $category, $location, $description, $paid, $hours, $qualifications, $url, $email);

        $error = array();

        $count = 0;

        if ($post->title == '') {
            $error[$count] = 'Title cannot be empty';
            $count++;
        }

        //
        if ($post->company == '') {
            $error[$count] = 'Company name cannot be empty';
            $count++;
        }

        //Error for if email and url are empty
        if ($post->url == '' && $post->email == '') {
            $error[$count] = 'Application type must be filled out.';
            $count++;
        }

        //URL validation
        if ($post->url !== '' && $post->email == '') {
            $pattern = '/^(https?):\/\/[^ "]+$/';
            if (!preg_match($pattern, $post->url)) {
                $error[$count] = 'URL needs to be valid. Example: https://www.google.com';
                $count++;
            }
        }

        //Email validation
        if ($post->url == '' && $post->email !== '') {
            if (strpos($email, '@') == false) {
                $error[$count] = 'Email needs to be valid. It needs to have an @ sign.';
                $count++;
            }
        }

        //location
        if ($post->location == '') {
            $error[$count] = 'Location must be provided.';
            $count++;
        }

        //category
        if ($post->category == '') {
            $error[$count] = 'Category must be selected.';
            $count++;
        }

        //Only require description and qualifications if the url is empty
        if ($post->url == '' && $post->email != '') {
            //description
            if ($post->description == '') {
                $error[$count] = 'Description must be provided.';
                $count++;
            }

            //qualifications
            if ($post->qualifications == '') {
                $error[$count] = 'Qualification requirements must be provided.';
                $count++;
            }
        }

        return $error;
    }

    /**
     * Creates a post object
     * @param $id               post_id value
     * @param $title            Post title
     * @param $company          Company name
     * @param $category         Post category
     * @param $location         Company location
     * @param $description      Post description
     * @param $paid             True if internship is paid
     * @param $hours            Hours of work per week
     * @param $qualifications   Internship qualifications
     * @param $url              Original post link
     * @param $email            Contact email
     * @return Post             Instance of the post class
     */
    private function createPost($id, $title, $company, $category, $location, $description, $paid, $hours, $qualifications, $url, $email)
    {
        //Create new post object
        $post = new Post();

        $post->title = $title;
        $post->url = $url;
        $post->company = $company;

       /* // check if checkboxes are checked ----------------------------------------------------------------------------------------------
        $category = implode(' <br> <br> ', $_POST['category']);

        for ($i=0; $i<sizeof($category); $i++){
                $category = $category ;
        }*/

        $post->category = $category;

        $post->location = $location;
        $post->description = $description;
        $post->qualifications = $qualifications;
        $post->hours = $hours;
        $post->email = $email;
        $post->paid = $paid;
        $post->post_id = $id;

        //Submit post
        return $post;
    }

    /**
     * Submits post to database
     *
     * @param $id               post_id value
     * @param $title            Post title
     * @param $company          Company name
     * @param $category         Post category
     * @param $location         Company location
     * @param $description      Post description
     * @param $paid             True if internship is paid
     * @param $hours            Hours of work per week
     * @param $qualifications   Internship qualifications
     * @param $url              Original post link
     * @param $email            Contact email
     */
    public function submitPost($id, $title, $company, $category, $location, $description, $paid, $hours, $qualifications, $url, $email)
    {

        $post = $this->createPost($id, $title, $company, $category, $location, $description, $paid, $hours, $qualifications, $url, $email);

        $sql = "INSERT INTO postings(company, url, title, description, paid, hours_per_week, location, category, qualifications, email)
                VALUES (:company, :url, :title, :description, :paid, :hours, :location, :category, :qualifications, :email)";

        $q = $this->db->prepare($sql);
        $q->bindValue("company", $post->company, PDO::PARAM_STR);
        $q->bindValue("url", $post->url, PDO::PARAM_STR);
        $q->bindValue("title", $post->title, PDO::PARAM_STR);
        $q->bindValue("description", $post->description, PDO::PARAM_STR);
        $q->bindValue("paid", $post->paid, PDO::PARAM_INT);
        $q->bindValue("hours", $post->hours, PDO::PARAM_INT);
        $q->bindValue("location", $post->location, PDO::PARAM_STR);
        $q->bindValue("category", $post->category, PDO::PARAM_STR);
        $q->bindValue("qualifications", $post->qualifications, PDO::PARAM_STR);
        $q->bindValue("email", $post->email, PDO::PARAM_STR);

        $q->execute();
    }

    /**
     * Updates existing post
     *
     * @param $id               post_id value
     * @param $title            Post title
     * @param $company          Company name
     * @param $category         Post category
     * @param $location         Company location
     * @param $description      Post description
     * @param $paid             True if internship is paid
     * @param $hours            Hours of work per week
     * @param $qualifications   Internship qualifications
     * @param $url              Original post link
     * @param $email            Contact email
     */
    public function updatePost($id, $title, $company, $category, $location, $description, $paid, $hours, $qualifications, $url, $email)
    {

        $post = $this->createPost($id, $title, $company, $category, $location, $description, $paid, $hours, $qualifications, $url, $email);

        $sql = "UPDATE postings SET company = :company, url = :url, title = :title, description = :description, paid = :paid,
                hours_per_week = :hours, location = :location, category = :category, qualifications = :qualifications,
                email = :email WHERE post_id = :id";

        $q = $this->db->prepare($sql);
        $q->bindValue("company", $post->company, PDO::PARAM_STR);
        $q->bindValue("url", $post->url, PDO::PARAM_STR);
        $q->bindValue("title", $post->title, PDO::PARAM_STR);
        $q->bindValue("description", $post->description, PDO::PARAM_STR);
        $q->bindValue("paid", $post->paid, PDO::PARAM_INT);
        $q->bindValue("hours", $post->hours, PDO::PARAM_INT);
        $q->bindValue("location", $post->location, PDO::PARAM_STR);
        $q->bindValue("category", $post->category, PDO::PARAM_STR);
        $q->bindValue("qualifications", $post->qualifications, PDO::PARAM_STR);
        $q->bindValue("email", $post->email, PDO::PARAM_STR);
        $q->bindValue("id", $post->post_id, PDO::PARAM_INT);

        $q->execute();
    }

    /**
     * Deletes existing post
     *
     * @param $id post_id value
     */
    public function deletePost($id)
    {

        $sql = "UPDATE postings SET deleted = true WHERE post_id = :id";

        $q = $this->db->prepare($sql);
        $q->bindValue("id", $id, PDO::PARAM_INT);

        $q->execute();

    }
}
