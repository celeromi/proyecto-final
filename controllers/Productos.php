<?php

include('libs/validator.php');     
include('models/producto.php');     
include('models/productoDAO.php');
include('controllers/errores.php');

class Productos extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){ 
        $productoDAO = new ProductoDAO();
        $productos = $productoDAO->read(0);
        $this->view->productos = $productos;
        $this->view->render('productos/index');
    }

    function create(){
        $this->view->render('productos/create');
    }

    function insert(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            /* Implmentar validación de datos */

            $producto = new Producto();
            $producto = $this->data_mapping($producto, $_POST);

            $productoDAO = new ProductoDAO();
            $resultado = $productoDAO->create($producto);

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

            $productoDAO = new ProductoDAO();
            $producto = $productoDAO->find_id($id);

            if ($producto){
                $this->view->producto = $producto;
                $this->view->render('productos/show');
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

            $productoDAO = new ProductoDAO();
            $producto = $productoDAO->find_id($id);

            if ($producto){
                $this->view->producto = $producto;
                $this->view->render('productos/edit');
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

            $producto = new Producto();
            $producto = $this->data_mapping($producto, $_POST);

            $productoDAO = new ProductoDAO();
            $resultado = $productoDAO->update($producto);

            if ($resultado){
                $this->render();
            } else {
                $controller = new Errores();
            }

        } else {
            $controller = new Errores();
        }
    }

    /* function find(){ // Metodo para busqueda - pendiente a implmentar } */

    function hide($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];
            
            $productoDAO = new ProductoDAO();

            $producto = $productoDAO->find_id($id);

            if ($producto){
                $resultado = $productoDAO->hide($producto->getIdproducto());

                if ($resultado){
                    $productos = $productoDAO->read(0);
                    $this->view->productos = $productos;
                    $this->view->render('productos/index');
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

            $productoDAO = new ProductoDAO();
            $producto = $productoDAO->find_id($id);

            if ($producto){
                $resultado = $productoDAO->delete($producto->getIdproducto());

                if ($resultado){
                    $productos = $productoDAO->read(0);
                    $this->view->productos = $productos;
                    $this->view->render('productos/index');
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

    private function data_mapping($producto, $post){
        if (isset($post['id_producto'])){
            $producto->setIdProducto($post['id_producto']);
        }
        $producto->setNombre($post['nombre']);
        $producto->setCategoria($post['categoria']);
        $producto->setDescripcion($post['descripcion']);
        $producto->setPrecioUnitario($post['precio_unitario']);
        $producto->setPrecioMayorista($post['precio_mayorista']);

        return $producto;
    }

    function data_validator($errors = []){

        /* if (!Validator::dni($_POST['dni'])) $errors[] = "El DNI debe tener 8 números.";
        if (!Validator::cuit($_POST['cuit'])) $errors[] = "El CUIL no tiene un formato válido.";
        if (!Validator::email($_POST['correo'])) $errors[] = "El correo electrónico no es válido.";
        if (!Validator::name($_POST['nombre'])) $errors[] = "El nombre solo puede contener letras.";
        if (!Validator::name($_POST['apellido'])) $errors[] = "El apellido solo puede contener letras.";
        if (!Validator::phone($_POST['contacto'])) $errors[] = "El número de contacto no es válido.";
        if (!Validator::address($_POST['direccion'])) $errors[] = "La dirección contiene caracteres inválidos.";
        if (!Validator::razon_social($_POST['razon_social'])) $errors[] = "La razon social solo puede contener letras.";

        if (!empty($errors)){
            $this->view->errores = $errors;
            $this->view->render('productos/create');
            return false;
        } */

        return true;
    }

} 

?>