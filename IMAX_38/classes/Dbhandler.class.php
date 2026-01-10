<?php

class Dbhandler {

  // إعدادات XAMPP
  private $host = "127.0.0.1";
  private $user = "root";
  private $pass = "";
  private $db   = "IMAXTECH";
  private $port = 3307;

    public $conn = null;

  public function __construct() {
    $this->conn = $this->connect();
  }

  private function connect() {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
      $conn = new mysqli($this->host, $this->user, $this->pass, $this->db, $this->port);
      $conn->set_charset("utf8mb4");
      return $conn;
    } catch (mysqli_sql_exception $e) {
      
      return null;
    }
  }

 
  public function conn() {
    
    if ($this->conn === null || ($this->conn instanceof mysqli && $this->conn->connect_errno)) {
      $this->conn = $this->connect();
    }

    return $this->conn;
  }
}
