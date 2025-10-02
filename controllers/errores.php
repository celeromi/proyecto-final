<?php

   class Errores extends Controller{
    
        function __construct(){
            parent::__construct();
            //echo '<p>Controlador de Error</p>';
            $this->view->mensaje = "Error al cargar el recurso";
            $this->view->render('errores/index');
        }
   } 

?>