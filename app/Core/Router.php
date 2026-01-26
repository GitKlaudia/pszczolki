<?php

class Router
{
    public function dispatch(): void
    {
        $controllerName = $_GET['controller'] ?? 'home';
        $actionName     = $_GET['action'] ?? 'index';

        $controllerClass = ucfirst($controllerName) . 'Controller';
        $controllerFile  = __DIR__ . '/../Controllers/' . $controllerClass . '.php';

        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo "Controller not found";
            return;
        }

        require_once $controllerFile;
        $controller = new $controllerClass();

        if (!method_exists($controller, $actionName)) {
            http_response_code(404);
            echo "Action not found";
            return;
        }

        $controller->$actionName();
    }
}