<?php

   class Nuevo extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "";
        }

        function render(){
            $this->view->render('nuevo/index');
        }

        function registrar(){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $matricula = $_POST['matricula'];
            

            if($this->model->insert(['matricula'=>$matricula, 'nombre'=>$nombre, 'apellido'=>$apellido,])){
                //echo "Registro Creado exitosamente";
                //volver al main?
                $mensaje = "Nuevo registro";
            }else{
                //echo "Error ya existe la matricula ingresada";
                $mensaje = "Error al registrar";
            }
            #$this->model->insert();

            $this->view->mensaje = $mensaje;
            $this->render();
        }



   } 

?>