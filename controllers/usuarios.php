<?php

   class Usuarios extends Controller{

        function __construct(){
            parent::__construct();
        }

        function render(){
            include('models/usuarioDAO.php'); 
            $usuarioDAO = new UsuarioDAO();
            $usuarios = $usuarioDAO->read(/* si le pongo atributo? para buscar solo los visibles */);
            $this->view->usuarios = $usuarios;
            $this->view->render('usuarios/index');
        }

        function create(){
            $this->view->render('usuarios/create');
        }

        function insert(){
            /* pendiente a implmentar */
        }

        function find(){
            $this->view->render('usuarios/find');
        }

        function update(){
            /* pendiente a implmentar */
        }

        function hide(){
            /* pendiente a implmentar */
        }

        function delete(){
            /* pendiente a implmentar */
        }

   } 

?>