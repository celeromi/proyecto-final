<?php
class Usuario {
    
    private $id_usuario;
    private $dni;
    private $cuil;
    private $correo;
    private $nombre;
    private $apellido;
    private $contacto;
    private $direccion;
    private $usuario;
    private $contrasena;
    private $archivado;

    // Constructor
    public function __construct(
        $dni = null, $cuil = null, $correo = null, $nombre = null, $apellido = null,
        $contacto = null, $direccion = null, $usuario = null, $contrasena = null, $archivado = 0){
        
        $this->dni        = $dni;
        $this->cuil       = $cuil;
        $this->correo     = $correo;
        $this->nombre     = $nombre;
        $this->apellido   = $apellido;
        $this->contacto   = $contacto;
        $this->direccion  = $direccion;
        $this->usuario    = $usuario;
        $this->contrasena = $contrasena;
        $this->archivado  = $archivado;
    }

    // Getters
    public function getIdUsuario()     { return $this->id_usuario; }
    public function getDni()           { return $this->dni; }
    public function getCuil()          { return $this->cuil; }
    public function getCorreo()        { return $this->correo; }
    public function getNombre()        { return $this->nombre; }
    public function getApellido()      { return $this->apellido; }
    public function getContacto()      { return $this->contacto; }
    public function getDireccion()     { return $this->direccion; }
    public function getUsuario()       { return $this->usuario; }
    public function getContrasena()    { return $this->contrasena; }
    public function getArchivado()     { return $this->archivado; }

    // Setters
    public function setIdUsuario($id)            { $this->id_usuario = $id; }
    public function setDni($dni)                 { $this->dni = $dni; }
    public function setCuil($cuil)               { $this->cuil = $cuil; }
    public function setCorreo($correo)           { $this->correo = $correo; }
    public function setNombre($nombre)           { $this->nombre = $nombre; }
    public function setApellido($apellido)       { $this->apellido = $apellido; }
    public function setContacto($contacto)       { $this->contacto = $contacto; }
    public function setDireccion($direccion)     { $this->direccion = $direccion; }
    public function setUsuario($usuario)         { $this->usuario = $usuario; }
    public function setContrasena($contrasena)   { $this->contrasena = $contrasena; }
    public function setArchivado($archivado)     { $this->archivado = $archivado; }
}
?>
