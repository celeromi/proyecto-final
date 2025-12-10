<?php

include('controllers/errores.php');

include('models/usuario.php');     
include('models/usuarioDAO.php');
include('models/cliente.php');     
include('models/clienteDAO.php');
include('models/producto.php');     
include('models/productoDAO.php');
include('models/presupuesto.php');     
include('models/presupuestoDAO.php');
include('models/presupuestoDetalle.php');     
include('models/presupuestoDetalleDAO.php');

class Presupuestos extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){

        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->read(0);
        $this->view->usuarios = $usuarios;

        $clienteDAO = new ClienteDAO();
        $clientes = $clienteDAO->read(0);
        $this->view->clientes = $clientes;

        $presupuestoDAO = new PresupuestoDAO();
        $presupuestos = $presupuestoDAO->read(0);
        $this->view->presupuestos = $presupuestos;
        
        $this->view->render('presupuestos/index');
    }

    function create(){
        $this->view->render('presupuestos/create');
    }

    function insert(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            /* Validación pendiente */

            // Mapeo del presupuesto
            $presupuesto = new Presupuesto();
            $presupuesto = $this->data_mapping($presupuesto, $_POST);

            $presupuestoDAO = new PresupuestoDAO();
            $resultado = $presupuestoDAO->create($presupuesto);

            // Obtener el ID generado
            $id_presupuesto = $presupuestoDAO->last_insert_id();

            // Mapeo de detalle (soporta múltiples detalles)
            if (!empty($_POST['id_producto']) && is_array($_POST['id_producto'])){

                foreach ($_POST['id_producto'] as $index => $producto_id){

                    $detalle = new PresupuestoDetalle();
                    $detalle = $this->data_mapping_det($detalle, [
                        'id_presupuesto' => $id_presupuesto,
                        'id_producto'    => $producto_id,
                        'cantidades'     => $_POST['cantidades'][$index] ?? 1
                    ]);

                    $detalleDAO = new PresupuestoDetalleDAO();
                    $detalleDAO->create($detalle);
                }
            }

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

        $presupuestoDAO = new PresupuestoDAO();
        $presupuesto = $presupuestoDAO->find_id($id);

        if (!$presupuesto){
            $controller = new Errores();
            return;
        }

        // === Detalles ===
        $presupuesto_id = $presupuesto->getIdPresupuesto();
        $detalleDAO = new PresupuestoDetalleDAO();
        $detalles = $detalleDAO->find_by_presupuesto($presupuesto_id);

        // === Usuario asociado ===
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->find_id($presupuesto->getIdUsuario());

        // === Cliente asociado (si existe) ===
        $cliente = null;
        if ($presupuesto->getIdCliente() != null){
            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->find_id($presupuesto->getIdCliente());
        }

        // === Productos de cada detalle ===
        $productoDAO = new ProductoDAO();
        $productos = [];

        foreach ($detalles as $det){
            $prod = $productoDAO->find_id($det->getIdProducto());
            $productos[$det->getIdDetalle()] = $prod;
        }

        // === Pasamos todo a la vista ===
        $this->view->presupuesto = $presupuesto;
        $this->view->usuario = $usuario;
        $this->view->cliente = $cliente;
        $this->view->detalles = $detalles;
        $this->view->productos = $productos;

        $this->view->render('presupuestos/show');
        
    } else {
        $controller = new Errores();
    }
}


    function edit($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];

            $presupuestoDAO = new PresupuestoDAO();
            $presupuesto = $presupuestoDAO->find_id($id);

            $detalleDAO = new PresupuestoDetalleDAO();
            $detalles = $detalleDAO->find_by_presupuesto($id);

            if ($presupuesto){
                $this->view->detalle = $detalles;
                $this->view->presupuesto = $presupuesto;
                $this->view->render('presupuestos/edit');
            } else {
                $controller = new Errores();
            }
        } else {
            $controller = new Errores();
        }
    }

    // ======================================================
    //  UPDATE
    // ======================================================
    function update(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $presupuesto = new Presupuesto();
            $presupuesto = $this->data_mapping($presupuesto, $_POST);

            $presupuestoDAO = new PresupuestoDAO();
            $resultado = $presupuestoDAO->update($presupuesto);

            // Actualizar detalles
            $detalleDAO = new PresupuestoDetalleDAO();
            $detalleDAO->delete_by_presupuesto($presupuesto->getIdPresupuesto());

            if (!empty($_POST['id_producto']) && is_array($_POST['id_producto'])){
                foreach ($_POST['id_producto'] as $index => $producto_id){
                    
                    $detalle = new PresupuestoDetalle();
                    $detalle = $this->data_mapping_det($detalle, [
                        'id_presupuesto' => $presupuesto->getIdPresupuesto(),
                        'id_producto'    => $producto_id,
                        'cantidades'     => $_POST['cantidades'][$index] ?? 1
                    ]);

                    $detalleDAO->create($detalle);
                }
            }

            if ($resultado){
                $this->render();
            } else {
                $controller = new Errores();
            }

        } else {
            $controller = new Errores();
        }
    }

    // ======================================================
    // FIND
    // ======================================================
    function find(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $buscar = $_POST['buscar'] ?? '';

            $presupuestoDAO = new PresupuestoDAO();
            $presupuestos = $presupuestoDAO->search($buscar);

            $this->view->presupuestos = $presupuestos;
            $this->view->render('presupuestos/index');

        } else {
            $controller = new Errores();
        }
    }

    // ======================================================
    // HIDE (ARCHIVAR)
    // ======================================================
    function hide($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];

            $presupuestoDAO = new PresupuestoDAO();
            $presupuesto = $presupuestoDAO->find_id($id);

            if ($presupuesto){
                $resultado = $presupuestoDAO->hide($presupuesto->getIdPresupuesto());

                if ($resultado){
                    $presupuestos = $presupuestoDAO->read(0);
                    $this->view->presupuestos = $presupuestos;
                    $this->view->render('presupuestos/index');
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

    // ======================================================
    // DELETE
    // ======================================================
    function delete($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];

            $presupuestoDAO = new PresupuestoDAO();
            $presupuesto = $presupuestoDAO->find_id($id);

            if ($presupuesto){

                // Borrar detalles primero
                $detalleDAO = new PresupuestoDetalleDAO();
                $detalleDAO->delete_by_presupuesto($id);

                // Luego borrar el presupuesto
                $resultado = $presupuestoDAO->delete($id);

                if ($resultado){
                    $presupuestos = $presupuestoDAO->read(0);
                    $this->view->presupuestos = $presupuestos;
                    $this->view->render('presupuestos/index');
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

    // ======================================================
    // DATA MAPPING
    // ======================================================
    private function data_mapping($presupuesto, $post){
        if (isset($post['id_presupuesto'])){
            $presupuesto->setIdPresupuesto($post['id_presupuesto']);
        }

        $presupuesto->setIdUsuario($post['id_usuario']);
        $presupuesto->setIdCliente($post['id_cliente']);
        $presupuesto->setFecha($post['fecha']);
        $presupuesto->setEstado($post['estado']);
        $presupuesto->setImporteFinal($post['importe_final']);
        $presupuesto->setArchivado($post['archivado'] ?? 0);

        return $presupuesto;
    }

    // ======================================================
    // DATA MAPPING DETALLE
    // ======================================================
    private function data_mapping_det($detalle, $post){
        if (isset($post['id_detalle'])){
            $detalle->setIdDetalle($post['id_detalle']);
        }

        $detalle->setIdPresupuesto($post['id_presupuesto']);
        $detalle->setIdProducto($post['id_producto']);
        $detalle->setCantidades($post['cantidades']);
        $detalle->setArchivado($post['archivado'] ?? 0);

        return $detalle;
    }

}

?>
