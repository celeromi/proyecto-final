<?php

include_once 'models/usuario.php';

class UsuarioDAO extends Model {

    public function __construct() {
        parent::__construct();
    }

    
    /* controlar el default de archivado es 0 */
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
    public function read($option) {
        $items = [];
        try {

            /* Se podría mejorar */
            if(($option == 0)||($option == 1)){
                $query = $this->db->connect()->query("SELECT * FROM usuarios WHERE archivado = $option");
            }else{
                $query = $this->db->connect()->query("SELECT * FROM usuarios");
            }

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

    public function find_id($id) {
        try {
            $query = $this->db->connect()->prepare("SELECT * FROM usuarios WHERE id_usuario = :id LIMIT 1");
            $query->execute(['id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($row['id_usuario']);
                $usuario->setDni($row['dni']);
                $usuario->setCuil($row['cuil']);
                $usuario->setCorreo($row['correo']);
                $usuario->setNombre($row['nombre']);
                $usuario->setApellido($row['apellido']);
                $usuario->setContacto($row['contacto']);
                $usuario->setDireccion($row['direccion']);
                $usuario->setUsuario($row['usuario']);
                $usuario->setContrasena($row['contrasena']);
                $usuario->setArchivado($row['archivado']);
                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    /* peniente a testear */
    public function find_dni($dni, $incluirArchivado = true) {
        try {
            // si no queremos incluir archivados, filtramos
            $sql = "SELECT * FROM usuarios WHERE dni = :dni";
            if (!$incluirArchivado) {
                $sql .= " AND archivado = 0";
            }
            $sql .= " LIMIT 1";

            $query = $this->db->connect()->prepare($sql);
            $query->execute(['dni' => $dni]);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($row['id_usuario']);
                $usuario->setDni($row['dni']);
                $usuario->setCuil($row['cuil']);
                $usuario->setCorreo($row['correo']);
                $usuario->setNombre($row['nombre']);
                $usuario->setApellido($row['apellido']);
                $usuario->setContacto($row['contacto']);
                $usuario->setDireccion($row['direccion']);
                $usuario->setUsuario($row['usuario']);
                $usuario->setContrasena($row['contrasena']);
                $usuario->setArchivado($row['archivado']);
                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function find_user($user) {
        try {
            $query = $this->db->connect()->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND archivado = 0 LIMIT 1");
            $query->execute(['usuario' => $user]);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($row['id_usuario']);
                $usuario->setDni($row['dni']);
                $usuario->setCuil($row['cuil']);
                $usuario->setCorreo($row['correo']);
                $usuario->setNombre($row['nombre']);
                $usuario->setApellido($row['apellido']);
                $usuario->setContacto($row['contacto']);
                $usuario->setDireccion($row['direccion']);
                $usuario->setUsuario($row['usuario']);
                $usuario->setContrasena($row['contrasena']);
                $usuario->setArchivado($row['archivado']);
                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
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
