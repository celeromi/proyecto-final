<?php

include_once 'models/usuario.php';

class UsuarioDAO extends Model {

    public function __construct() {
        parent::__construct();
    }

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
            error_log('UsuarioDAO::create -> ' . $e->getMessage());
            return false;
        }
    }

    public function read() {
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT * FROM usuarios");

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
            error_log('UsuarioDAO::read -> ' . $e->getMessage());
            return [];
        }
    }

    public function update(Usuario $usuario) {
        try {
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
                    contrasena = :contrasena,
                    archivado = :archivado
                WHERE id_usuario = :id_usuario
            ");

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
                'archivado'   => $usuario->getArchivado(),
                'id_usuario'  => $usuario->getIdUsuario()
            ]);

            return true;
        } catch (PDOException $e) {
            error_log('UsuarioDAO::update -> ' . $e->getMessage());
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
            error_log('UsuarioDAO::hide -> ' . $e->getMessage());
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
            error_log('UsuarioDAO::delete -> ' . $e->getMessage());
            return false;
        }
    }
}

?>
