<?php

    include('models/usuario.php');     
    include('models/usuarioDAO.php');
    include('controllers/errores.php');

   class Usuarios extends Controller{

        function __construct(){
            parent::__construct();
        }

        function render(){
             
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

        //function hide($id){/* pendiente a implmentar */}

        //function delete($id){/* pendiente a implmentar */}

        function hide($param = null) {
            if (isset($param) && is_array($param) && count($param) > 0) {
                $id = $param[0]; // El primer valor del array es el ID

                
                $usuarioDAO = new UsuarioDAO();

                $usuario = $usuarioDAO->find_id($id);

                if ($usuario) {
                    $resultado = $usuarioDAO->hide($usuario->getIdUsuario());

                    if ($resultado) {
                        /* pendiente a implmentar sistema de mensajes */
                        $usuarios = $usuarioDAO->read(0);
                        $this->view->usuarios = $usuarios;
                        $this->view->render('usuarios/index');
                    } else {
                        $controller = new Errores();
                    }
                } else {
                    $controller = new Errores();
                }
            } else {
                $controller = new Errores();
            }
        }

        function delete($param = null) {
            if (isset($param) && is_array($param) && count($param) > 0) {
                $id = $param[0]; // El primer valor del array es el ID

                
                $usuarioDAO = new UsuarioDAO();

                $usuario = $usuarioDAO->find_id($id);

                if ($usuario) {
                    $resultado = $usuarioDAO->delete($usuario->getIdUsuario());

                    if ($resultado) {
                        /* pendiente a implmentar sistema de mensajes */
                        $usuarios = $usuarioDAO->read(0);
                        $this->view->usuarios = $usuarios;
                        $this->view->render('usuarios/index');
                    } else {
                        $controller = new Errores();
                    }
                } else {
                    $controller = new Errores();
                }
            } else {
                $controller = new Errores();
            }
        }


   } 

?>