<?php

class PresupuestoDetalle {

    private $id_detalle;
    private $id_presupuesto;
    private $id_producto;
    private $cantidades;
    private $archivado;

    public function __construct(
        $id_detalle = null,
        $id_presupuesto = null,
        $id_producto = null,
        $cantidades = null,
        $archivado = null
    ){
        $this->id_detalle = $id_detalle;
        $this->id_presupuesto = $id_presupuesto;
        $this->id_producto = $id_producto;
        $this->cantidades = $cantidades;
        $this->archivado = $archivado;
    }

    // GETTERS
    public function getIdDetalle()      {return $this->id_detalle;}
    public function getIdPresupuesto()  {return $this->id_presupuesto;}
    public function getIdProducto()     {return $this->id_producto;}
    public function getCantidades()     {return $this->cantidades;}
    public function getArchivado()      {return $this->archivado;}

    // SETTERS
    public function setIdDetalle($id_detalle)           {$this->id_detalle = $id_detalle;}
    public function setIdPresupuesto($id_presupuesto)   {$this->id_presupuesto = $id_presupuesto;}
    public function setIdProducto($id_producto)         {$this->id_producto = $id_producto;}
    public function setCantidades($cantidades)          {$this->cantidades = $cantidades;}
    public function setArchivado($archivado)            {$this->archivado = $archivado;}

}

?>
