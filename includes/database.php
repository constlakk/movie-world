<?php

class Database {

    public $connection;

    function __construct() {
    
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($this->connection->connect_errno) {

            die("Could not connect to database.");

        }

    }

    private function verify_query($result) {

        if(!$result) {

            die("Could not execute query.");

        }

    }

    public function query($sql) {

        //echo $sql;

        $result = $this->connection->query($sql);

        $this->verify_query($result);

        return $result;

    }



    public function escape_string($string) {

        return $this->connection->real_escape_string($string);

    }

    public function insert_id() {

        //return $this->connection->insert_id;
        return mysqli_insert_id($this->connection);

    }

}

$db = new Database();

?>