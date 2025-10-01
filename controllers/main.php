<?php

   class Main extends Controller{

        function __construct(){
            echo '<p>Controllador Main</p>';
            parent::__construct();
            $this->view->render('main/index');
        }

        function alive(){
            echo '<p>Main Alive</p>';
        }
   } 

?>