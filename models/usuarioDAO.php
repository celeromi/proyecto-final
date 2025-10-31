<?php

include_once 'models/usuario.php';

class UsuarioDAO extends Model {

    public function __construct() {
        parent::__construct();
    }

    
    /* controlar el default de archivado a 0 */
    public function create(Usuario $usuario) {
        try {
            $query = $this->db->connect()->prepare(" INSERT INTO usuarios 
                (dni, cuil, correo, nombre, apellido, contacto, direccion, usuario, contrasena, archivado)
                VALUES (:dni, :cuil, :correo, :nombre, :apellido, :contacto, :direccion, :usuario, :contrasena, :archivado)");

            $query->execute([
                'dni'        => $usuario->getDni(),
                'cuil'       => $usuario->getCuil(),
                'correo'     => $usuario->getCorreo(),
                'nombre'     => $usuario->getNombre(),
                'apellido'   => $usuario->getApellido(),
                'contacto'   => $usuario->getContacto(),
                'direccion'  => $usuario->getDireccion(),
                'usuario'    => $usuario->getUsuario(),
                'contrasena' => $usuario->getContrasena(),
                'archivado'  => $usuario->getArchivado()
            ]);

            return true;
        } catch (PDOException $e) {
            /* pendiente a mejorar mensaje de error */
            return false;
        }
    }

    /* a futuro podría modificarse para darle un atributo // → 0 = visibles // → 1 = ocultos // → 2 = todos // */
    public function read() {
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT * FROM usuarios /* clavar un where aca */");

            while ($row = $query->fetch()) {
                $item = new Usuario();
                $item->setIdUsuario($row['id_usuario']);
                $item->setDni($row['dni']);
                $item->setCuil($row['cuil']);
                $item->setCorreo($row['correo']);
                $item->setNombre($row['nombre']);
                $item->setApellido($row['apellido']);
                $item->setContacto($row['contacto']);
                $item->setDireccion($row['direccion']);
                $item->setUsuario($row['usuario']);
                $item->setContrasena($row['contrasena']);
                $item->setArchivado($row['archivado']);

                array_push($items, $item);
            }
            return $items;

        } catch (PDOException $e) {
            /* pendiente a mejorar mensaje de error */
            return [];
        }
    }

    public function find_id($id){
        /* pendienete a implmentar, no importa si esta archivado*/
    }

        public function find_dni($dni){
        /* pendienete a implmentar, importa si esta archivado?*/
    }

    public function update(Usuario $usuario) {
        try {
            /* todo menos archivado */
            $query = $this->db->connect()->prepare("
                UPDATE usuarios SET
                    dni = :dni,
                    cuil = :cuil,
                    correo = :correo,
                    nombre = :nombre,
                    apellido = :apellido,
                    contacto = :contacto,
                    direccion = :direccion,
                    usuario = :usuario,
                    contrasena = :contrasena
                WHERE id_usuario = :id_usuario");

            $query->execute([
                'dni'         => $usuario->getDni(),
                'cuil'        => $usuario->getCuil(),
                'correo'      => $usuario->getCorreo(),
                'nombre'      => $usuario->getNombre(),
                'apellido'    => $usuario->getApellido(),
                'contacto'    => $usuario->getContacto(),
                'direccion'   => $usuario->getDireccion(),
                'usuario'     => $usuario->getUsuario(),
                'contrasena'  => $usuario->getContrasena(),
                'id_usuario'  => $usuario->getIdUsuario()
            ]);

            return true;
        } catch (PDOException $e) {
            /* pendiente a mejorar mensaje de error */
            return false;
        }
    }

    public function hide($id_usuario) {
        try {
            $query = $this->db->connect()->prepare("
                UPDATE usuarios SET archivado = 1 WHERE id_usuario = :id_usuario
            ");
            $query->execute(['id_usuario' => $id_usuario]);
            return true;
        } catch (PDOException $e) {
            /* pendiente a mejorar mensaje de error */
            return false;
        }
    }

    public function delete($id_usuario) {
        try {
            $query = $this->db->connect()->prepare("
                DELETE FROM usuarios WHERE id_usuario = :id_usuario
            ");
            $query->execute(['id_usuario' => $id_usuario]);
            return true;
        } catch (PDOException $e) {
            /* pendiente a mejorar mensaje de error */
            return false;
        }
    }
}

?>
