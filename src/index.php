<?php
session_start();

// Getting the Autoload
require 'Vendor/App/SplClassLoader.php';
require_once 'Config/autoload.php';

$router = new \Vendor\Core\Router();
$router->getController();
