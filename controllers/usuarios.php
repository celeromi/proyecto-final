<?php

   class Usuarios extends Controller{

        function __construct(){
            parent::__construct();
        }

        function render(){
            include('models/usuarioDAO.php'); 
            $usuarioDAO = new UsuarioDAO();
            $usuarios = $usuarioDAO->read(0);
            $this->view->usuarios = $usuarios;
            $this->view->render('usuarios/index');
        }

        function create(){
            $this->view->render('usuarios/create');
        }

        /* pendiente a implmentar sistema de validación de datos */
        function insert() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                include('models/usuario.php'); 
                $usuario = new Usuario();
                $usuario->setDni($_POST['dni']);
                $usuario->setCuil($_POST['cuil']);
                $usuario->setCorreo($_POST['correo']);
                $usuario->setNombre($_POST['nombre']);
                $usuario->setApellido($_POST['apellido']);
                $usuario->setContacto($_POST['contacto']);
                $usuario->setDireccion($_POST['direccion']);
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasena($_POST['contrasena']);
                $usuario->setArchivado(0); /* Esta visible / No esta oculto*/

                include('models/usuarioDAO.php'); 
                $usuarioDAO = new UsuarioDAO();
                $resultado = $usuarioDAO->create($usuario);

                if ($resultado) {
                    /* pendiente a implmentar sistema de mensajes */
                    $this->view->usuarios = $usuarios;
                    $this->view->render('usuarios/index');
                } else {
                    /* pendiente a mejorar sistema de errores */
                    $controller = new Errores();
                }
            } else {
                /* pendiente a mejorar sistema de errores */
                $controller = new Errores();
            }
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