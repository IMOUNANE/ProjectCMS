<?php
session_start();

// Autoload
require 'Vendor/App/SplLoader.php';
SplLoader::register();

// Router
$router = new \Vendor\App\Router();
$router->getController();
