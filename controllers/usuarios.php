<?php

include('libs/hash.php');
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

    function insert() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /* Implmentar validación de datos */

            $usuario = new Usuario();
            $usuario = $this->data_mapping($usuario, $_POST);

            $usuarioDAO = new UsuarioDAO();
            $resultado = $usuarioDAO->create($usuario);

            if ($resultado) {
                $this->render();
            } else {
                $controller = new Errores();
            }
        } else {
            $controller = new Errores();
        }
    }

    function show($param = null) {
        if (isset($param) && is_array($param) && count($param) > 0) {
            $id = $param[0];

            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->find_id($id);

            if ($usuario) {
                $this->view->usuario = $usuario;
                $this->view->render('usuarios/show');
            } else {
                $controller = new Errores();
            }
        } else {
            $controller = new Errores();
        }
    }

    function edit($param = null){
        if (isset($param) && is_array($param) && count($param) > 0) {
            $id = $param[0];

            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->find_id($id);

            if ($usuario) {
                $this->view->usuario = $usuario;
                $this->view->render('usuarios/edit');
            } else {
                $controller = new Errores();
            }
        } else {
            $controller = new Errores();
        }
    }

    function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /* Implementar metodo de control de datos */

            $usuario = new Usuario();
            $usuario = $this->data_mapping($usuario, $_POST);

            $usuarioDAO = new UsuarioDAO();
            $resultado = $usuarioDAO->update($usuario);

            if ($resultado) {
                $this->render();
            } else {
                $controller = new Errores();
            }

        } else {
            $controller = new Errores();
        }
    }

    function find(){ 
        /* Metodo para busqueda - pendiente a implmentar */
    }

    function hide($param = null) {
        if (isset($param) && is_array($param) && count($param) > 0) {
            $id = $param[0];
            
            $usuarioDAO = new UsuarioDAO();

            $usuario = $usuarioDAO->find_id($id);

            if ($usuario) {
                $resultado = $usuarioDAO->hide($usuario->getIdUsuario());

                if ($resultado) {
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
            $id = $param[0];

            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->find_id($id);

            if ($usuario) {
                $resultado = $usuarioDAO->delete($usuario->getIdUsuario());

                if ($resultado) {
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

    private function data_mapping($usuario, $post){

        if (isset($post['id_usuario'])) {
            $usuario->setIdUsuario($post['id_usuario']);
        }

        $usuario->setDni($post['dni']);
        $usuario->setCuil($post['cuil']);
        $usuario->setCorreo($post['correo']);
        $usuario->setNombre($post['nombre']);
        $usuario->setApellido($post['apellido']);
        $usuario->setContacto($post['contacto']);
        $usuario->setDireccion($post['direccion']);
        $usuario->setUsuario($post['usuario']);

        if (!empty($post['contrasena'])) {
            $usuario->setContrasena(Hash::create($post['contrasena']));
        } else if (isset($post['id_usuario'])) {
            $usuarioDAO = new UsuarioDAO();
            $usuarioExistente = $usuarioDAO->find_id($post['id_usuario']);
            $usuario->setContrasena($usuarioExistente->getContrasena());
        }

        return $usuario;
    }

    /* verificar logica e implmentar e terminar de implmentar */
    function data_validator($errors = []){

        if (!Validator::dni($_POST['dni'])) $errors[] = "El DNI debe tener 8 números.";
        if (!Validator::cuil($_POST['cuil'])) $errors[] = "El CUIL no tiene un formato válido.";
        if (!Validator::email($_POST['correo'])) $errors[] = "El correo electrónico no es válido.";
        if (!Validator::name($_POST['nombre'])) $errors[] = "El nombre solo puede contener letras.";
        if (!Validator::name($_POST['apellido'])) $errors[] = "El apellido solo puede contener letras.";
        if (!Validator::phone($_POST['contacto'])) $errors[] = "El número de contacto no es válido.";
        if (!Validator::address($_POST['direccion'])) $errors[] = "La dirección contiene caracteres inválidos.";
        if (!Validator::username($_POST['usuario'])) $errors[] = "El usuario debe ser alfanumérico y sin espacios.";
        if (!Validator::password($_POST['contrasena'])) $errors[] = "La contraseña debe tener 8+ caracteres, una letra, un número y un símbolo.";

        if (!empty($errors)) {
            $this->view->errores = $errors;
            $this->view->render('usuarios/create');
            return false;
        }
        return true;

    }

} 

?>