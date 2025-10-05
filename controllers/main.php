<?php

   class Main extends Controller{

        function __construct(){
            //echo '<p>Controllador Main</p>';
            parent::__construct();
        }

        function render(){
            $this->view->render('main/index');
        }

   } 

?>