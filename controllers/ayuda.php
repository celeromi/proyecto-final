<?php

   class Ayuda extends Controller{
    
        function __construct(){
            parent::__construct();
            //echo '<p>Controlador de Ayuda</p>';
            $this->view->render('ayuda/index');
        }
   } 

?>