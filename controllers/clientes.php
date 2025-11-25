<?php

/* include('libs/hash.php'); */
include('libs/validator.php');     
include('models/cliente.php');     
include('models/clienteDAO.php');
include('controllers/errores.php');

class clientes extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){ 
        $clienteDAO = new ClienteDAO();
        $clientes = $clienteDAO->read(0);
        $this->view->clientes = $clientes;
        $this->view->render('clientes/index');
    }

    function create(){
        $this->view->render('clientes/create');
    }

    function insert(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            /* Implmentar validación de datos */

            $cliente = new Cliente();
            $cliente = $this->data_mapping($cliente, $_POST);

            $clienteDAO = new ClienteDAO();
            $resultado = $clienteDAO->create($cliente);

            if ($resultado){
                $this->render();
            } else {
                $controller = new Errores();
            }
        } else {
            $controller = new Errores();
        }
    }

    function show($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];

            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->find_id($id);

            if ($cliente){
                $this->view->cliente = $cliente;
                $this->view->render('clientes/show');
            } else {
                $controller = new Errores();
            }
        } else {
            $controller = new Errores();
        }
    }

    function edit($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];

            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->find_id($id);

            if ($cliente){
                $this->view->cliente = $cliente;
                $this->view->render('clientes/edit');
            } else {
                $controller = new Errores();
            }
        } else {
            $controller = new Errores();
        }
    }

    function update(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            /* Implementar metodo de control de datos */

            $cliente = new Cliente();
            $cliente = $this->data_mapping($cliente, $_POST);

            $clienteDAO = new ClienteDAO();
            $resultado = $clienteDAO->update($cliente);

            if ($resultado){
                $this->render();
            } else {
                $controller = new Errores();
            }

        } else {
            $controller = new Errores();
        }
    }

    /* function find(){ 
        // Metodo para busqueda - pendiente a implmentar
    } */

    function hide($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];
            
            $clienteDAO = new ClienteDAO();

            $cliente = $clienteDAO->find_id($id);

            if ($cliente){
                $resultado = $clienteDAO->hide($cliente->getIdcliente());

                if ($resultado){
                    $clientes = $clienteDAO->read(0);
                    $this->view->clientes = $clientes;
                    $this->view->render('clientes/index');
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

    function delete($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];

            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->find_id($id);

            if ($cliente){
                $resultado = $clienteDAO->delete($cliente->getIdcliente());

                if ($resultado){
                    $clientes = $clienteDAO->read(0);
                    $this->view->clientes = $clientes;
                    $this->view->render('clientes/index');
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

    private function data_mapping($cliente, $post){
        if (isset($post['id_cliente'])){
            $cliente->setIdCliente($post['id_cliente']);
        }
        $cliente->setDni($post['dni']);
        $cliente->setCuil($post['cuit']);
        $cliente->setCorreo($post['correo']);
        $cliente->setNombre($post['nombre']);
        $cliente->setApellido($post['apellido']);
        $cliente->setContacto($post['contacto']);
        $cliente->setDireccion($post['direccion']);
        $cliente->setRazonSocial($post['razon_social']);

        /* if (!empty($post['contrasena'])){
            $cliente->setContrasena(Hash::create($post['contrasena']));
        } else if (isset($post['id_cliente'])){
            $clienteDAO = new ClienteDAO();
            $clienteExistente = $clienteDAO->find_id($post['id_cliente']);
            $cliente->setContrasena($clienteExistente->getContrasena());
        } */

        return $cliente;
    }

    function data_validator($errors = []){

        if (!Validator::dni($_POST['dni'])) $errors[] = "El DNI debe tener 8 números.";
        if (!Validator::cuit($_POST['cuit'])) $errors[] = "El CUIL no tiene un formato válido.";
        if (!Validator::email($_POST['correo'])) $errors[] = "El correo electrónico no es válido.";
        if (!Validator::name($_POST['nombre'])) $errors[] = "El nombre solo puede contener letras.";
        if (!Validator::name($_POST['apellido'])) $errors[] = "El apellido solo puede contener letras.";
        if (!Validator::phone($_POST['contacto'])) $errors[] = "El número de contacto no es válido.";
        if (!Validator::address($_POST['direccion'])) $errors[] = "La dirección contiene caracteres inválidos.";
        if (!Validator::razon_social($_POST['razon_social'])) $errors[] = "La razon social solo puede contener letras.";

        if (!empty($errors)){
            $this->view->errores = $errors;
            $this->view->render('clientes/create');
            return false;
        }
        return true;
    }

} 

?>