<?php
/* Performs database operations for editable site setting
 *
 * File: htmlContent.php
 * @author Rajpreet Dhaliwal
 * Date Created: 5/28/2020
 */

/** Performs database operations for editable site setting
 * @author Rajpreet Dhaliwal
 * Date Created: 5/28/2020
 */


class siteSetting{
    // db connection
    private $_dbh;
/**
* siteSetting constructor
* @param PDO $dbh database connection object
*/

    /**
     * siteSetting constructor.
     * @param PDO $dbh database context
     */
    public function __construct(PDO $dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * Gets color to be used for color picker 1
     * @return array db result
     */
    public function getColor1()
    {
        $sql = "SELECT color_hex
                FROM site_color where site_color_id = 1";

        $statement = $this->_dbh->prepare($sql);

        //$statement->bindParam(':color1', $color1);
        $statement->execute();
        //echo $statement;
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Gets Color to be used for color picker 2
     * @return array db result
     */
    public function getColor2()
    {
        $sql = "SELECT color_hex
                FROM site_color where site_color_id = 2";

        $statement = $this->_dbh->prepare($sql);

//        $statement->bindParam(':color2', $color2);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Gets Color to be used for color picker 2
     * @return array db result
     */
    public function getColor3()
    {
        $sql = "SELECT color_hex
                FROM site_color where site_color_id = 3";

        $statement = $this->_dbh->prepare($sql);

//        $statement->bindParam(':color3', $color3);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Updates color in db to new color
     * @param $color_hex string new color hex
     * @param $color_id number id of color in database
     * @return bool
     */
    public function setColor($color_hex, $color_id)
    {
        $sql = "UPDATE site_color
                SET color_hex = :color_hex where site_color_id = :color_id";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':color_hex', $color_hex);
        $statement->bindParam(':color_id', $color_id);

        return $statement->execute();
    }
}