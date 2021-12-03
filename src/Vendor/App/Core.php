<?php
namespace Core;

use App\Router;

class Core {

    public function run(){
        $route = Router::get($_SERVER["REQUEST_URI"]); //la methode get recupere le get des l url
        if ($route !== null) { //si celle ci correspond a une route predefini elle est renvoyé afin d'exploiter son tableau
            $controller = "src\Controller\\" . ucfirst($route["controller"])
             . "Controller";
            $method = $route["action"] . "Action";
            $obj = new $controller(); // le controller appel donc sa class et sa methode
            $obj->$method();
        }
        else {
            require("src/View/Error/404.php"); //si aucun route n'existe un erreur est renvoyé
        }
    }
}
