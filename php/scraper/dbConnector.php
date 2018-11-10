<?php
/**
 * Created by PhpStorm.
 * User: Lappy
 * Date: 11/3/2018
 * Time: 12:33 PM
 */

class dbConnector
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "test";
    private $tablename;
    private $conn;

    public function __construct($tablename)
    {
        $this->tablename = $tablename;
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        echo "Connected successfully\n";
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function runQuery($sql){
        $result = $this->conn->query($sql);
        if ($result) {
            echo "Executed successfully :" . $sql . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
        return $result;
    }

    public function close(){
        $this->conn->close();
    }

}