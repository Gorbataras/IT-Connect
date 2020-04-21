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

/**
 * Class ResourcesModel - Interacts with the resources table in the database
 */
class ResourcesModel
{

    // Fields
    protected $db;

    // Constructor
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Retrieves student resources body html
     * 
     * @return mixed student resources body html
     */
    public function getBody()
    {
        $sql = "SELECT body FROM resources";
        $q = $this->db->prepare($sql);

        $q->execute();
        $body = $q->fetch();

        return $body;

    }

    /**
     * Updates the new body for resources page
     * 
     * @param $newBody          New Body for resources page
     */
    public function updateBody($newBody)
    {
        $sql = "UPDATE resources SET body = :body";
        $q = $this->db->prepare($sql);
        $q->bindValue("body", $newBody, PDO::PARAM_STR);

        $q->execute();
    }

}