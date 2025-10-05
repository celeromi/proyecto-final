<?php

   class Ayuda extends Controller{
    
        function __construct(){
            parent::__construct();
            //echo '<p>Controlador de Ayuda</p>';
        }

        function render(){
            $this->view->render('ayuda/index');
        }
   } 

?>