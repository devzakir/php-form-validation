<?php
  class Database{
    private $hostdb = "localhost";
    private $userdb = "zakirbdt_zakir2";
    private $passdb = "S.F571]Opf";
    private $namedb = "zakirbdt_apps";
    public $pdo;

    function __construct(){
      if (!isset($this->pdo)){
        try {
          $link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb, $this->userdb, $this->passdb);
          $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $link->exec("SET CHARACTER SET utf8");
          $this->pdo = $link;
      } catch (PDOException $e) {
          die("Failed to connect with Database".$e->getMessage());
        }

      }

    }
  }

 ?>
