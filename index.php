<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';

class Router
{
    private $routes = [];
    private $prefix;

    public function __construct($prefix = '')
    {
        $this->prefix = trim($prefix, '/');
    }

    public function addRoute($uri, $controllerMethod)
    {
        $this->routes[trim($uri, '/')] = $controllerMethod;
    }

    public function route($url)
    {
        // Suppression du préfixe du début de l'URL
        if ($this->prefix && strpos($url, $this->prefix) === 0) {
            $url = substr($url, strlen($this->prefix) + 1);
        }

        // Suppression des barres obliques en trop
        $url = trim($url, '/');

        foreach ($this->routes as $uri => $action) {

            // transforme route en exp
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $uri);
            $pattern = "#^" . $pattern . "$#";

            //match avec motif et l'URL
            if (preg_match($pattern, $url, $matches)) {
                //garde que les params
                array_shift($matches);

                // Extraction du nom du contrôleur et de la méthode
                list($controllerName, $methodName) = explode('@', $action);

                // Instanciation du contrôleur et appel de la méthode + le param
                $controller = new $controllerName();
                call_user_func_array([$controller, $methodName], $matches);
                return;
            }
        }

        $errorController = new ErrorController();
        $errorController->notFound();
    }
}

// Instanciation du routeur
$router = new Router('DemoMVCAlpha');

// Ajout des routes
$router->addRoute('', 'HomeController@index'); // Pour la racine
$router->addRoute('tasks', 'TaskController@all'); // Pour la racine
$router->addRoute('tasks/{id}', 'TaskController@byId');
$router->addRoute('about', 'AboutController@index');

// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));
