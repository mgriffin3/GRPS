<?php
/**
 * Created by PhpStorm.
 * User: Lappy
 * Date: 11/7/2018
 * Time: 10:35 PM
 */

class challengeHandler
{
    private $info;
    private $list;

    public function __construct()
    {
        $this->info = new siteInfo;       //create an object with relevant website information
        $this->list = new SplDoublyLinkedList();
    }

    public function handle(){
        $this->info->getDataFromIndex($this->list);
        $this->list->rewind();
        while($this->list->valid()){
            $this->info->getDataFromChallenge($this->list->current());
            $this->list->next();
        }
    }

    public function insertChallengesFromList(){
        $conn = new dbConnector($this->info->site);
        $this->list->rewind();
        while($this->list->valid()){
            $this->insertChallenge($conn, $this->list->current());
            $this->list->next();
        }
    }

    //dynamically generate sql query from challenge information
    public function insertChallenge($conn, $challenge){
        $sqlCols = "INSERT INTO `" . $challenge->site . "` (";
        $sqlVals = "VALUES (";
        $url = $conn->conn->real_escape_string($challenge->url);
        $title = $conn->conn->real_escape_string($challenge->title);
        $text = $conn->conn->real_escape_string($challenge->text);

        if (isset($url)){
            $sqlCols .= "`url`, ";
            $sqlVals .= "'" . $url . "',";
        }
        if (isset($title)){
            $sqlCols .= "`title`, ";
            $sqlVals .= "'" . $title . "',";
        }
        if (isset($text)){
            $sqlCols .= "`text` ";
            $sqlVals .= "'" . $text . "'";
        }
        $sqlCols = rtrim($sqlCols, ',');
        $sqlCols = $sqlCols . ")";
        $sqlVals = rtrim($sqlVals, ',');
        $sqlVals = $sqlVals . ")";
        $sql = $sqlCols . $sqlVals;

        $conn->runQuery($sql);
    }

}