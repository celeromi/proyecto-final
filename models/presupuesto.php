<?php

class Presupuesto {

    private $id_presupuesto;
    private $id_usuario;
    private $id_cliente;
    private $fecha;
    private $estado;
    private $importe_final;
    private $archivado;

    public function __construct(
        $id_usuario = null,
        $id_cliente = null,
        $fecha = null,
        $estado = null,
        $importe_final = null,
        $archivado = 0
    ){
        $this->id_usuario     = $id_usuario;
        $this->id_cliente     = $id_cliente;
        $this->fecha          = $fecha;
        $this->estado         = $estado;
        $this->importe_final  = $importe_final;
        $this->archivado      = $archivado;
    }

    // GETTERS
    public function getIdPresupuesto()   { return $this->id_presupuesto; }
    public function getIdUsuario()       { return $this->id_usuario; }
    public function getIdCliente()       { return $this->id_cliente; }
    public function getFecha()           { return $this->fecha; }
    public function getEstado()          { return $this->estado; }
    public function getImporteFinal()    { return $this->importe_final; }
    public function getArchivado()       { return $this->archivado; }

    // SETTERS
    public function setIdPresupuesto($id)      { $this->id_presupuesto = $id; }
    public function setIdUsuario($id_usuario)  { $this->id_usuario = $id_usuario; }
    public function setIdCliente($id_cliente)  { $this->id_cliente = $id_cliente; }
    public function setFecha($fecha)           { $this->fecha = $fecha; }
    public function setEstado($estado)         { $this->estado = $estado; }
    public function setImporteFinal($importe)  { $this->importe_final = $importe; }
    public function setArchivado($archivado)   { $this->archivado = $archivado; }
}

?>