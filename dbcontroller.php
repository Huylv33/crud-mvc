<?php

class DbController {
  private $host = "localhost";
  private $user = "root";
  private $password = "";
  private $database;
  private $conn;
  function __construct($database)
  { 
    $this->$conn = $this->connectDB();
  }
  function connectDB() {
    $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
    return $conn;
  }
  function executeQuery($query) {
    $result = mysqli_query($this->conn,$query);
    return $result;    
  }
  function closeDb() {
    mysqli_close($this->conn);
  }
}
?>