<?php

   class Controller{

        function __construct(){
            echo '<p>Controllador Base</p>';
            $this->view = new View();
        }

   } 

?>