<?php
class Usuario {
    
    private $id;
    private $dni;
    private $telefono;
    private $notas;
    private $direccion;
    //private $nivel;
    private $contrasena;
    private $apellido;
    private $nombre;
    private $grupo_sanguineo;
    private $fecha_nacimiento;
    private $fecha_alta;

    // Constructor
    public function __construct(
        $dni, $telefono, $direccion, 
        //$nivel, 
        $contrasena, $apellido, 
        $nombre, $grupo_sanguineo, $fecha_nacimiento, $fecha_alta, $notas = "") {
        
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        //$this->nivel = $nivel;
        $this->contrasena = $contrasena;
        $this->apellido = $apellido;
        $this->nombre = $nombre;
        $this->grupo_sanguineo = $grupo_sanguineo;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->fecha_alta = $fecha_alta;
        $this->notas = $notas;
    }

    // Getters y Setters

    public function getId() { return $this->id; }
    //public function setId($id) { $this->id = $id; }

    public function getDni() { return $this->dni; }
    public function setDni($dni) { $this->dni = $dni; }

    public function getTelefono() { return $this->telefono; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }

    public function getNotas() { return $this->notas; }
    public function setNotas($notas) { $this->notas = $notas; }

    public function getDireccion() { return $this->direccion; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }

    //public function getNivel() { return $this->nivel; }
    //public function setNivel($nivel) { $this->nivel = $nivel; }

    public function getContrasena() { return $this->contrasena; }
    public function setContrasena($contrasena) { $this->contrasena = $contrasena; }

    public function getApellido() { return $this->apellido; }
    public function setApellido($apellido) { $this->apellido = $apellido; }

    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }

    public function getGrupoSanguineo() { return $this->grupo_sanguineo; }
    public function setGrupoSanguineo($grupo_sanguineo) { $this->grupo_sanguineo = $grupo_sanguineo; }

    public function getFechaNacimiento() { return $this->fecha_nacimiento; }
    public function setFechaNacimiento($fecha_nacimiento) { $this->fecha_nacimiento = $fecha_nacimiento; }

    public function getFechaAlta() { return $this->fecha_alta; }
    public function setFechaAlta($fecha_alta) { $this->fecha_alta = $fecha_alta; }
}
?>
