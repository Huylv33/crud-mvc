<?php

class DbConfig {
  private $host = "localhost";
  private $user = "root";
  private $password = "";
  private $database;
  private $conn;
  function __construct($database)
  { 
    $this->database = $database;
  }
  function getDB() {
    return $this->database;
  }
  function connectDB() {
    if (!mysqli_connect($this->host,$this->user,$this->password,$this->database)) {
      throw new Exception("Lỗi");      
    }
    else $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    return $this->conn;
  }
  function closeDb() {
    mysqli_close($this->conn);
  }
}
?>