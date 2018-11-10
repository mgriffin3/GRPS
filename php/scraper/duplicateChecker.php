<?php
/**
 * Created by PhpStorm.
 * User: Lappy
 * Date: 11/4/2018
 * Time: 10:38 AM
 */

class duplicateChecker
{
    private $lastConstructed;

    //create a challenge object based on the most recent upload to database.  Used to avoid uploading identical challenges multiple times.
    public function __construct($table)
    {
        $conn = new dbConnector($table);
        $sql = "SELECT * FROM " . $table . " ORDER BY ID DESC LIMIT 1;";        //last entry to table
        $result = $conn->runQuery($sql);
//        $conn->close();
        //todo:replace with foreach assoc if able
        //builds challenge with information from db
        if ($result->num_rows == 1) {
            $row =  $result->fetch_assoc();
            $id = $row['id'];
            $url = $row['url'];
            $title = $row['title'];
            $text = $row['text'];
            $this->lastConstructed = new challenge($table, $id, $url, $title, $text);
        } else {    //todo: handle empty database
            $this->lastConstructed = new challenge(null,null, null, null, null);
            echo "The database is empty \n";
        }
    }

    public function __get($property)
    {
        return $this->$property;
    }

    //returns true if urls match
    public function compare($url){
        if ($url == $this->lastConstructed->url){
            return true;
        }
        return false;
    }
}