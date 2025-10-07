<?php

    class App{
        
        function __construct(){
            
            //echo '<p>Nueva App</p>';
            
            $url = isset($_GET['url']) ? $_GET['url'] : null; //si exsite es y sino es null
            $url = rtrim($url, '/');
            $url = explode('/', $url);

            // Ingreso sin controllador
            if(empty($url[0])){
                $archivoController = 'controllers/main.php';
                require_once $archivoController;
                $controller = new Main();
                $controller->loadModel('main');
                $controller->render();
                return false;
            }
            $archivoController = 'controllers/'.$url[0].'.php';

            // Ingreso con controlador
            if(file_exists($archivoController)){
                require_once $archivoController;

                // Inicializo el controlador
                $controller = new $url[0];
                $controller->loadModel($url[0]);

                //tomar parametros
                $nparam = sizeof($url);
                if($nparam>1){
                    if($nparam>2){
                        $param = [];
                        for($i = 2; $i<$nparam; $i++){
                            array_push($param, $url[$i]);
                        }
                        $controller->{$url[1]}($param);
                    }else{
                        $controller->{$url[1]}();
                    }
                }else{
                    $controller->render();
                }
                
                //Si hay metodo que se necesita cargar
                //if(isset($url[1])){
                //    $controller->{$url[1]}();
                //}else{
                //   $controller->render();
                //}

            }else{
                require_once 'controllers/errores.php';
                $controller = new Errores();
            }

            




        }
        
    }

?>