<?php

   class Usuarios extends Controller{

        function __construct(){
            parent::__construct();
        }

        function render(){
            include('models/usuarioDAO.php'); 
            $usuarioDAO = new UsuarioDAO();
            $usuarios = $usuarioDAO->read();
            $this->view->usuarios = $usuarios;
            $this->view->render('usuarios/index');
        }

   } 

?>