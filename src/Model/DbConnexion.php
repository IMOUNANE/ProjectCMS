<?php


namespace Model;

use PDO;

abstract class DbConnexion
{
    protected $db;

    public function __construct($servername="localhost",$dbname="homestead",$username="root",$password="root")
    {
      
      try {
         $this->db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); 
          // set the PDO error mode to exception
           $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
          }
      catch(PDOException $e)
          {
          echo "Connection failed: " . $e->getMessage();
          }

    }  
}