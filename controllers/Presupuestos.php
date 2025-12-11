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

    // ====================================================== //
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

    // ====================================================== //
    function create(){
        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->read(0);
        $this->view->usuarios = $usuarios;

        $clienteDAO = new ClienteDAO();
        $clientes = $clienteDAO->read(0);
        $this->view->clientes = $clientes;

        $productoDAO = new ProductoDAO();
        $productos = $productoDAO->read(0);
        $this->view->productos = $productos;
        
        $this->view->render('presupuestos/create');
    }

    // ====================================================== //
    function insert(){

        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
            new Errores();
            return;
        }

        if (empty($_POST['id_usuario']) || empty($_POST['fecha'])){
            new Errores("Faltan campos obligatorios");
            return;
        }

        $presupuesto = new Presupuesto();
        $presupuesto = $this->data_mapping($presupuesto, $_POST);

        $presupuestoDAO = new PresupuestoDAO();

        if (!$presupuestoDAO->create($presupuesto)){
            new Errores("No se pudo insertar el presupuesto");
            return;
        }
        $id_presupuesto = $presupuestoDAO->last_insert_id();

        //var_dump($id_presupuesto); exit;
        if (!empty($_POST['id_producto'])){
            
            for ($i = 0; $i < count($_POST['id_producto']); $i++){
                $detalle = new PresupuestoDetalle();

                $detalle->setIdPresupuesto($id_presupuesto);
                $detalle->setIdProducto($_POST['id_producto'][$i]);
                $detalle->setCantidades($_POST['cantidades'][$i]);
                $detalle->setArchivado(0);

                $detalleDAO = new PresupuestoDetalleDAO();
                $detalleDAO->create($detalle);
            }
        }

        $this->render();
    }


    // ====================================================== //
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

    // ====================================================== //
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

    // ====================================================== //
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

    // ====================================================== //
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

    // ====================================================== //
    function hide($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];
            $presupuestoDAO = new PresupuestoDAO();
            $presupuesto = $presupuestoDAO->find_id($id);
            if($presupuesto){
                $presupuestoDAO->hide($id);
                $presupuestoDetalleDAO = new PresupuestoDetalleDAO();
                $detalles = $presupuestoDetalleDAO->find_by_presupuesto($id);
                if($detalles){
                    foreach ($detalles as $detalle) {
                        $presupuestoDetalleDAO->hide($detalle->getIdDetalle());
                    }
                }
                $this->render();
                return;
            }else{
                /* No se encontro presupuesto */
                $controller = new Errores();
            }
        } else {
            /* No se envio Parámetro */
            $controller = new Errores();
        }
    }

    // ====================================================== //
    function delete($param = null){
        if (isset($param) && is_array($param) && count($param) > 0){
            $id = $param[0];
            $presupuestoDAO = new PresupuestoDAO();
            $presupuesto = $presupuestoDAO->find_id($id);
            if($presupuesto){
                $presupuestoDAO->delete($id);
                $presupuestoDetalleDAO = new PresupuestoDetalleDAO();
                $detalles = $presupuestoDetalleDAO->find_by_presupuesto($id);
                if($detalles){
                    foreach ($detalles as $detalle) {
                        $presupuestoDetalleDAO->delete($detalle->getIdDetalle());
                    }
                }
                $this->render();
                return;
            }else{
                /* No se encontro presupuesto */
                $controller = new Errores();
            }
        } else {
            /* No se envio Parámetro */
            $controller = new Errores();
        }
    }

        // ====================================================== //
        function update_status($param = null){
            if (!isset($param) || !is_array($param) || count($param) < 2){
                $controller = new Errores();
                return;
            }

            $id = intval($param[0]);
            $estado = ucfirst(strtolower($param[1]));

            $estados_validos = ["Pendiente", "Aprobado", "Rechazado"];
            if (!in_array($estado, $estados_validos)){
                $controller = new Errores();
                return;
            }

            $presupuestoDAO = new PresupuestoDAO();
            $resultado = $presupuestoDAO->update_status($id, $estado);

            if ($resultado){
                $this->render();
            } else {
                $controller = new Errores();
            }
        }


    // ====================================================== //
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

    // ====================================================== //
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
