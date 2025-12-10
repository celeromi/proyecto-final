<?php

include('controllers/errores.php');

include('models/presupuesto.php');     
include('models/presupuestoDAO.php');
include('models/presupuestoDetalle.php');     
include('models/presupuestoDetalleDAO.php');

class Presupuestos extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){
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

            /* Validadción de datos presupuesto */
            
            /* Validadción de datos detalles */
            
            $presupuesto = new Presupuesto();
            $presupuesto = $this->data_mapping($presupuesto, $_POST);

            $presupuestoDAO = new PresupuestoDAO();
            $resultado = $presupuestoDAO->create($presupuesto);

            $detalles = new presupuestoDetalle();
            $detalles = $this->data_mapping_det($detalles, $_POST);

            $detallesDAO = new presupuestoDetalleDAO();
            $resultado = $detallesDAO->create($detalles);

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

            $presupuesto_id = $presupuesto->getIdPresupuesto();
            $detalleDAO = new PresupuestoDetalleDAO();
            $detalles = $detalleDAO->find_by_presupuesto($presupuesto_id);

            if ($presupuesto){
                $this->view->detalle = $detalles;
                $this->view->presupuesto = $presupuesto;
                $this->view->render('presupuestos/show');
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

            $presupuestoDAO = new PresupuestoDAO();
            $presupuesto = $presupuestoDAO->find_id($id);

            $presupuesto_id = $presupuesto->getIdPresupuesto();
            $detalleDAO = new PresupuestoDetalleDAO();
            $detalles = $detalleDAO->find_by_presupuesto($presupuesto_id);

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

    function update(){
        /*  */
    }

    function find(){ 
        /*  */
    }

    function hide(){
        /*  */
    }

    function delete(){
        /*  */
    }

    function data_mapping(){
        /*  */
    }

    function data_mapping_det(){
        /*  */
    }

} 

?>