<?php

include_once 'models/usuario.php';

class UsuarioDAO extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function create(){}

    public function read(){
        $items = [];
        try{
            
            $query = $this->db->connect()->query("SELECT * FROM usuarios");
            
            while($row = $query->fetch()){
                $item               = new Usuario();
                
                $item->dni          = $row['dni'];
                $item->cuil         = $row['cuil'];
                $item->correo       = $row['correo'];
                $item->nombre       = $row['nombre'];
                $item->apellido     = $row['apellido'];
                $item->contacto     = $row['contacto'];
                $item->direccion    = $row['direccion'];
                $item->usuario      = $row['usuario'];
                $item->contrasena   = $row['contrasena'];
                $item->archivado    = $row['archivado'];

                array_push($items, $item);
            }
            return $items;

        }catch(PDOException $e){
            return[];
        }
    }

    public function update(){}

    public function delete(){}

    /* public function get(){
        $items = [];
        try{
            
            $query = $this->db->connect()->query("SELECT * FROM alumnos");
            
            while($row = $query->fetch()){
                $item = new Alumno();
                $item->matricula = $row['matricula'];
                $item->nombre = $row['nombre'];
                $item->apellido = $row['apellido'];

                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            return[];
        }

    } */

    /* public function getById($id){
        $item = new Alumno();

        $query = $this->db->connect()->prepare("SELECT * FROM alumnos WHERE matricula = :matricula");
        try{
            $query->execute(['matricula' => $id]);
            while($row = $query->fetch()){
                $item->matricula = $row['matricula'];
                $item->nombre = $row['nombre'];
                $item->apellido = $row['apellido'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    } */

    /* public function update($item){
        $query = $this->db->connect()->prepare("UPDATE alumnos SET nombre = :nombre, apellido = :apellido WHERE matricula = :matricula");
        try{
            $query->execute([
                'matricula' => $item['matricula'],
                'nombre' => $item['nombre'],
                'apellido' => $item['apellido']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    } */

    /* public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM alumnos WHERE matricula = :id");
        try{
            $query->execute(['id' => $id]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    } */ 

}
?>