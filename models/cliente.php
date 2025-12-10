
<?php
class Cliente {
    private $id_cliente;
    private $dni;
    private $cuit;
    private $correo;
    private $nombre;
    private $apellido;
    private $contacto;
    private $direccion;
    private $razon_social;
    private $archivado;

    public function __construct($dni = null, $cuit = null, $correo = null, $nombre = null, $apellido = null, $contacto = null, $direccion = null, $razon_social = null, $archivado = 0){
        $this->dni          = $dni;
        $this->cuit         = $cuit;
        $this->correo       = $correo;
        $this->nombre       = $nombre;
        $this->apellido     = $apellido;
        $this->contacto     = $contacto;
        $this->direccion    = $direccion;
        $this->razon_social = $razon_social;
        $this->archivado    = $archivado;
    }

    public function getIdCliente()      { return $this->id_cliente; }
    public function getDni()            { return $this->dni; }
    public function getCuit()           { return $this->cuit; }
    public function getCorreo()         { return $this->correo; }
    public function getNombre()         { return $this->nombre; }
    public function getApellido()       { return $this->apellido; }
    public function getContacto()       { return $this->contacto; }
    public function getDireccion()      { return $this->direccion; }
    public function getRazonSocial()    { return $this->razon_social; }
    public function getArchivado()      { return $this->archivado; }

    public function setIdCliente($id)             { $this->id_cliente = $id; }
    public function setDni($dni)                  { $this->dni = $dni; }
    public function setCuit($cuit)                { $this->cuit = $cuit; }
    public function setCorreo($correo)            { $this->correo = $correo; }
    public function setNombre($nombre)            { $this->nombre = $nombre; }
    public function setApellido($apellido)        { $this->apellido = $apellido; }
    public function setContacto($contacto)        { $this->contacto = $contacto; }
    public function setDireccion($direccion)      { $this->direccion = $direccion; }
    public function setRazonSocial($razon_social){ $this->razon_social = $razon_social; }
    public function setArchivado($archivado)      { $this->archivado = $archivado; }
}
?>
