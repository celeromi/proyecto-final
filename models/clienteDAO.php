<?php

include_once 'models/cliente.php';

class ClienteDAO extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function create(Cliente $cliente){
        try {
            $query = $this->db->connect()->prepare(" 
                INSERT INTO clientes 
                (dni, cuit, correo, nombre, apellido, contacto, direccion, razon_social, archivado)
                VALUES (:dni, :cuit, :correo, :nombre, :apellido, :contacto, :direccion, :razon_social, :archivado)
            ");

            $query->execute([
                'dni'          => $cliente->getDni(),
                'cuit'         => $cliente->getCuit(),
                'correo'       => $cliente->getCorreo(),
                'nombre'       => $cliente->getNombre(),
                'apellido'     => $cliente->getApellido(),
                'contacto'     => $cliente->getContacto(),
                'direccion'    => $cliente->getDireccion(),
                'razon_social' => $cliente->getRazonSocial(),
                'archivado'    => $cliente->getArchivado()
            ]);

            return true;
        } catch (PDOException $e){
            return false;
        }
    }

    public function read($option){
        $items = [];

        try {
            if ($option == 0 || $option == 1) {
                $query = $this->db->connect()->query("SELECT * FROM clientes WHERE archivado = $option");
            } else {
                $query = $this->db->connect()->query("SELECT * FROM clientes");
            }

            while ($row = $query->fetch()){
                $item = new Cliente();
                $item->setIdCliente($row['id_cliente']);
                $item->setDni($row['dni']);
                $item->setCuit($row['cuit']);
                $item->setCorreo($row['correo']);
                $item->setNombre($row['nombre']);
                $item->setApellido($row['apellido']);
                $item->setContacto($row['contacto']);
                $item->setDireccion($row['direccion']);
                $item->setRazonSocial($row['razon_social']);
                $item->setArchivado($row['archivado']);

                array_push($items, $item);
            }

            return $items;

        } catch (PDOException $e){
            return [];
        }
    }

    public function find_id($id){
        try {
            $query = $this->db->connect()->prepare("SELECT * FROM clientes WHERE id_cliente = :id LIMIT 1");
            $query->execute(['id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row){
                $cliente = new Cliente();
                $cliente->setIdCliente($row['id_cliente']);
                $cliente->setDni($row['dni']);
                $cliente->setCuit($row['cuit']);
                $cliente->setCorreo($row['correo']);
                $cliente->setNombre($row['nombre']);
                $cliente->setApellido($row['apellido']);
                $cliente->setContacto($row['contacto']);
                $cliente->setDireccion($row['direccion']);
                $cliente->setRazonSocial($row['razon_social']);
                $cliente->setArchivado($row['archivado']);

                return $cliente;
            }
            return null;

        } catch (PDOException $e){
            return null;
        }
    }

    public function find_dni($dni, $incluirArchivado = true){
        try {
            $sql = "SELECT * FROM clientes WHERE dni = :dni";
            if (!$incluirArchivado){
                $sql .= " AND archivado = 0";
            }
            $sql .= " LIMIT 1";

            $query = $this->db->connect()->prepare($sql);
            $query->execute(['dni' => $dni]);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row){
                $cliente = new Cliente();
                $cliente->setIdCliente($row['id_cliente']);
                $cliente->setDni($row['dni']);
                $cliente->setCuit($row['cuit']);
                $cliente->setCorreo($row['correo']);
                $cliente->setNombre($row['nombre']);
                $cliente->setApellido($row['apellido']);
                $cliente->setContacto($row['contacto']);
                $cliente->setDireccion($row['direccion']);
                $cliente->setRazonSocial($row['razon_social']);
                $cliente->setArchivado($row['archivado']);

                return $cliente;
            }
            return null;

        } catch (PDOException $e){
            return null;
        }
    }

    public function update(Cliente $cliente){
        try {
            $query = $this->db->connect()->prepare("
                UPDATE clientes SET
                    dni = :dni,
                    cuit = :cuit,
                    correo = :correo,
                    nombre = :nombre,
                    apellido = :apellido,
                    contacto = :contacto,
                    direccion = :direccion,
                    razon_social = :razon_social
                WHERE id_cliente = :id_cliente
            ");

            $query->execute([
                'dni'          => $cliente->getDni(),
                'cuit'         => $cliente->getCuit(),
                'correo'       => $cliente->getCorreo(),
                'nombre'       => $cliente->getNombre(),
                'apellido'     => $cliente->getApellido(),
                'contacto'     => $cliente->getContacto(),
                'direccion'    => $cliente->getDireccion(),
                'razon_social' => $cliente->getRazonSocial(),
                'id_cliente'   => $cliente->getIdCliente()
            ]);

            return true;

        } catch (PDOException $e){
            return false;
        }
    }

    public function hide($id_cliente){
        try {
            $query = $this->db->connect()->prepare("
                UPDATE clientes SET archivado = 1 WHERE id_cliente = :id_cliente
            ");
            $query->execute(['id_cliente' => $id_cliente]);
            return true;

        } catch (PDOException $e){
            return false;
        }
    }

    public function delete($id_cliente){
        try {
            $query = $this->db->connect()->prepare("
                DELETE FROM clientes WHERE id_cliente = :id_cliente
            ");
            $query->execute(['id_cliente' => $id_cliente]);
            return true;

        } catch (PDOException $e){
            return false;
        }
    }
}

?>
