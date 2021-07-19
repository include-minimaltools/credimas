<?php 

require_once 'controllers/ErrorController.php';

class App
{
    function __construct()
    {
        $url = isset($_GET['url']) ?
            $_GET['url'] : 
            null;

        $url = rtrim($url, '/');
        $url = explode('/',$url);

        if(empty($url[0]))
        {
            $controller = 'controllers/LoginController.php';
            require_once $controller;
            $controller = new LoginController();
            $controller->InitModel('login');
            $controller->Render();
            return false;
        }
        
        $controller = 'controllers/' . $url[0] . 'Controller.php';

        
        if(file_exists($controller))
        {
            require_once $controller;

            $controllerName = $url[0] . 'Controller';
            $controller = new $controllerName;
            $controller->InitModel($url[0]);

            if(isset($url[1]))
                if(method_exists($controller, $url[1]))
                    if(isset($url[2]))
                    {
                        $parameters = [];
                        
                        for($i = 0; $i < count($url) - 2; $i++)
                            array_push($parameters, $url[$i] + 2);

                        $controller->{$url[1]}($parameters);
                    }
                    else
                        $controller->{$url[1]}();
                else
                    error_log('APP::construct-> No existe el metodo especificado');
            else
                $controller->Render();
        }
        else
        {
            error_log('APP::construct-> No existe el controlador especificado');
            $controller = 'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->InitModel('Error');
            $controller->Render();
        }
    }
}?>