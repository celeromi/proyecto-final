<?php

   class Nuevo extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->render('nuevo/index');
        }

        function registrar(){
            echo "Registro Creado";
            $this->model->insert();
        }

   } 

?>