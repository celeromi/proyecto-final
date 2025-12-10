<?php

class App {

    function __construct(){

        include_once 'libs/session.php';
        $session = new Session();

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        /*  */
        $controladoresPublicos = ['login', 'ayuda']; 

        /*  */
        $controladorActual = isset($url[0]) && $url[0] != '' ? $url[0] : 'main';
        if (!in_array($controladorActual, $controladoresPublicos)){
            if (!$session->exists('user')){
                header('Location: ' . constant('URL') . 'login');
                exit();
            }
        }

        if (empty($url[0])){
            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . '.php';

        if (file_exists($archivoController)){
            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            $nparam = sizeof($url);

            if ($nparam > 1){
                if ($nparam > 2){
                    $param = [];
                    for ($i = 2; $i < $nparam; $i++){
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                } else {
                    if (method_exists($controller, $url[1])){
                        $controller->{$url[1]}();
                    } else {
                        require_once 'controllers/errores.php';
                        $controller = new Errores();
                    }
                }
            } else {
                $controller->render();
            }

        } else {
            require_once 'controllers/errores.php';
            $controller = new Errores();
        }
    }
}
