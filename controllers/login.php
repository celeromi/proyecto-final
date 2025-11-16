<?php

include('libs/hash.php');

class Login extends Controller {

    function __construct() {
        parent::__construct();
    }

    function render() {
        $this->view->render('login/index');
    }

    function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = trim($_POST['usuario']);
            $contrasena = trim($_POST['contrasena']);

            include_once 'libs/session.php';
            $session = new Session();

            /* testeo temporal  */
            if ($usuario === 'admin' && $contrasena === 'admin') {
                $session->set('user', [
                    'id' => 0,
                    'nombre' => 'Administrador',
                    'nivel' => 2,
                    'usuario' => 'admin'
                ]);
                
                header('Location: ' . constant('URL') . 'usuarios');
                exit();
            }
            /* testeo temporal  */

            include_once 'models/usuarioDAO.php';
            $usuarioDAO = new UsuarioDAO();
            
            /*  */$user = $usuarioDAO->find_user($usuario);

            /* if ($user && $user->getContrasena() === $contrasena) { */
            if ($user && Hash::verify($contrasena, $user->getContrasena())) {
                // Inicio de sesión normal
                $session->set('user', [
                    'id' => $user->getIdUsuario(),
                    'nombre' => $user->getNombre(),
                    'usuario' => $user->getUsuario(),
                    'nivel' => 2 /* pensado para permisos */
                ]);
                header('Location: ' . constant('URL') . 'usuarios');
            } else {
                $this->view->error = "Usuario o contraseña incorrectos";
                $this->view->render('login/index');
            }
        } else {
            require_once 'controllers/errores.php';
            $controller = new Errores();
        }
    }

}
