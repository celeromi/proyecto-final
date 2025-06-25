<?php
class Producto {
    private $id_producto;
    private $nombre;
    private $categoria;
    private $descripcion;
    private $precio_unitario;
    private $precio_mayorista;
    private $archivado;

    // Constructor
    public function __construct($nombre = null, $categoria = null, $descripcion = null, $precio_unitario = null, $precio_mayorista = null, $archivado = 0) {
        $this->nombre           = $nombre;
        $this->categoria        = $categoria;
        $this->descripcion      = $descripcion;
        $this->precio_unitario  = $precio_unitario;
        $this->precio_mayorista = $precio_mayorista;
        $this->archivado        = $archivado;
    }

    // Getters
    public function getIdProducto()        { return $this->id_producto; }
    public function getNombre()            { return $this->nombre; }
    public function getCategoria()         { return $this->categoria; }
    public function getDescripcion()       { return $this->descripcion; }
    public function getPrecioUnitario()    { return $this->precio_unitario; }
    public function getPrecioMayorista()   { return $this->precio_mayorista; }
    public function getArchivado()         { return $this->archivado; }

    // Setters
    public function setIdProducto($id)                 { $this->id_producto = $id; }
    public function setNombre($nombre)                 { $this->nombre = $nombre; }
    public function setCategoria($categoria)           { $this->categoria = $categoria; }
    public function setDescripcion($descripcion)       { $this->descripcion = $descripcion; }
    public function setPrecioUnitario($precio)         { $this->precio_unitario = $precio; }
    public function setPrecioMayorista($precio)        { $this->precio_mayorista = $precio; }
    public function setArchivado($archivado)           { $this->archivado = $archivado; }
}
?>
