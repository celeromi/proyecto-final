<?php

class PresupuestoDetalle {

    private $id_detalle;
    private $id_presupuesto;
    private $id_producto;
    private $cantidad;
    private $precio_unitario;
    private $subtotal;

    public function __construct(
        $id_presupuesto = null, $id_producto = null,
        $cantidad = null, $precio_unitario = null, $subtotal = null
    ){
        $this->id_presupuesto = $id_presupuesto;
        $this->id_producto    = $id_producto;
        $this->cantidad       = $cantidad;
        $this->precio_unitario= $precio_unitario;
        $this->subtotal       = $subtotal;
    }

    // GETTERS
    public function getIdPresupuesto() { return $this->id_presupuesto; }
    public function getFecha()         { return $this->fecha; }
    public function getIdCliente()     { return $this->id_cliente; }
    public function getTotal()         { return $this->total; }
    public function getObservaciones() { return $this->observaciones; }
    public function getArchivado()     { return $this->archivado; }

    // SETTERS
    public function setIdPresupuesto($id)   { $this->id_presupuesto = $id; }
    public function setFecha($fecha)        { $this->fecha = $fecha; }
    public function setIdCliente($id_cli)   { $this->id_cliente = $id_cli; }
    public function setTotal($total)        { $this->total = $total; }
    public function setObservaciones($obs)  { $this->observaciones = $obs; }
    public function setArchivado($arch)     { $this->archivado = $arch; }
}


?>