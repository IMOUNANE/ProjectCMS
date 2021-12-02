<?php


namespace Model;

use PDO;

abstract class BaseManager
{
    protected $db;

    public function __construct($servername="mysql",$dbname="homestead",$username="root",$password="secret")
    {
        
        try {
            $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            ob_start();
            ?>
            <h1>Error Database</h1>
            <p><?= $e->getMessage(); ?></p>
            <?php
            echo ob_get_clean();
        }
        return $this->db = $db;
    }
}