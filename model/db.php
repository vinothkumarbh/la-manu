<?php

class DatabaseConnection {

    protected $con;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        try {
        $this->con = new PDO('mysql:host=localhost;dbname=hospitale2n', 'root', '');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function reading_data($q) {
        $result = $this->con->query($q) or die($this->con->errorCode());
        if($result->rowCount() > 0) return $result;
        else return null;
    }

    public function add_data($q) {
        $test = $this->con->prepare($q)->execute([$q]);
        return $test;
    }

     public function delete_data($q) {
        $this->con->prepare($q)->execute([$q]);
    }
}
