<?php

    include('libs/validator.php'); 
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

/* ///////////////////////////////////////////////////////////////////////////////////////////////////////// */

        function insert() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $errors = [];

                // Validaciones
                if (!Validator::dni($_POST['dni'])) $errors[] = "El DNI debe tener 8 números.";
                if (!Validator::cuil($_POST['cuil'])) $errors[] = "El CUIL no tiene un formato válido.";
                if (!Validator::email($_POST['correo'])) $errors[] = "El correo electrónico no es válido.";
                if (!Validator::name($_POST['nombre'])) $errors[] = "El nombre solo puede contener letras.";
                if (!Validator::name($_POST['apellido'])) $errors[] = "El apellido solo puede contener letras.";
                if (!Validator::phone($_POST['contacto'])) $errors[] = "El número de contacto no es válido.";
                if (!Validator::address($_POST['direccion'])) $errors[] = "La dirección contiene caracteres inválidos.";
                if (!Validator::username($_POST['usuario'])) $errors[] = "El usuario debe ser alfanumérico y sin espacios.";
                if (!Validator::password($_POST['contrasena'])) $errors[] = "La contraseña debe tener 8+ caracteres, una letra, un número y un símbolo.";

                // Si hay errores, los mostramos
                if (!empty($errors)) {
                    $this->view->errores = $errors;
                    $this->view->render('usuarios/create');
                    return;
                }

                // Si pasa todas las validaciones, guardamos el usuario
                $usuario = new Usuario();
                $usuario->setDni($_POST['dni']);
                $usuario->setCuil($_POST['cuil']);
                $usuario->setCorreo($_POST['correo']);
                $usuario->setNombre($_POST['nombre']);
                $usuario->setApellido($_POST['apellido']);
                $usuario->setContacto($_POST['contacto']);
                $usuario->setDireccion($_POST['direccion']);
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasena(password_hash($_POST['contrasena'], PASSWORD_DEFAULT));
                $usuario->setArchivado(0);

                $usuarioDAO = new UsuarioDAO();
                $resultado = $usuarioDAO->create($usuario);

                if ($resultado) {
                    $this->render();
                } else {
                    $controller = new Errores();
                }
            }
        }

/* ///////////////////////////////////////////////////////////////////////////////////////////////////////// */


        function edit($param = null){
            if (isset($param) && is_array($param) && count($param) > 0) {
                $id = $param[0]; // El ID del usuario desde la URL

                $usuarioDAO = new UsuarioDAO();
                $usuario = $usuarioDAO->find_id($id);

                if ($usuario) {
                    // Pasamos el usuario a la vista
                    $this->view->usuario = $usuario;
                    $this->view->render('usuarios/edit');
                } else {
                    // Si no lo encuentra, mostramos error
                    $controller = new Errores();
                }
            } else {
                // Si no hay parámetro o está mal formado
                $controller = new Errores();
            }
        }

/* ///////////////////////////////////////////////////////////////////////////////////////////////////////// */

        function update() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                require_once 'helpers/Validator.php';

                $errors = [];

                // Validaciones de campos
                if (!Validator::dni($_POST['dni'])) $errors[] = "El DNI debe tener exactamente 8 números.";
                if (!Validator::cuil($_POST['cuil'])) $errors[] = "El CUIL no tiene un formato válido.";
                if (!Validator::email($_POST['correo'])) $errors[] = "El correo electrónico no es válido.";
                if (!Validator::name($_POST['nombre'])) $errors[] = "El nombre solo puede contener letras y espacios.";
                if (!Validator::name($_POST['apellido'])) $errors[] = "El apellido solo puede contener letras y espacios.";
                if (!Validator::phone($_POST['contacto'])) $errors[] = "El número de contacto no es válido.";
                if (!Validator::address($_POST['direccion'])) $errors[] = "La dirección contiene caracteres inválidos.";
                if (!Validator::username($_POST['usuario'])) $errors[] = "El usuario debe ser alfanumérico y sin espacios.";

                // Contraseña (solo si se modificó)
                if (!empty($_POST['contrasena'])) {
                    if (!Validator::password($_POST['contrasena'])) {
                        $errors[] = "La contraseña debe tener al menos 8 caracteres, incluir una letra, un número y un símbolo.";
                    }
                }

                // Si hay errores, mostrar de nuevo el formulario de edición
                if (!empty($errors)) {
                    $usuarioDAO = new UsuarioDAO();
                    $usuario = $usuarioDAO->find_id($_POST['id_usuario']); // recuperamos datos actuales para no perderlos

                    $this->view->usuario = $usuario;
                    $this->view->errores = $errors;
                    $this->view->render('usuarios/edit');
                    return;
                }

                // Si todo está validado correctamente
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['id_usuario']);
                $usuario->setDni($_POST['dni']);
                $usuario->setCuil($_POST['cuil']);
                $usuario->setCorreo($_POST['correo']);
                $usuario->setNombre($_POST['nombre']);
                $usuario->setApellido($_POST['apellido']);
                $usuario->setContacto($_POST['contacto']);
                $usuario->setDireccion($_POST['direccion']);
                $usuario->setUsuario($_POST['usuario']);

                $usuarioDAO = new UsuarioDAO();

                // Si la contraseña fue enviada, la actualizamos; si no, mantenemos la existente
                if (!empty($_POST['contrasena'])) {
                    $usuario->setContrasena(password_hash($_POST['contrasena'], PASSWORD_DEFAULT));
                } else {
                    $usuarioExistente = $usuarioDAO->find_id($_POST['id_usuario']);
                    $usuario->setContrasena($usuarioExistente->getContrasena());
                }

                $resultado = $usuarioDAO->update($usuario);

                if ($resultado) {
                    // Mensaje de éxito (podés implementarlo luego con un sistema de alertas)
                    $this->render(); 
                } else {
                    $controller = new Errores();
                }

            } else {
                $controller = new Errores();
            }
        }

/* ///////////////////////////////////////////////////////////////////////////////////////////////////////// */


        function find(){ 
            /* Metodo para busqueda - pendiente a implmentar */
        }

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