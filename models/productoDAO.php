<?php

include_once 'models/producto.php';

class ProductoDAO extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function create(Producto $producto){
        try {
            $query = $this->db->connect()->prepare(" 
                INSERT INTO productos 
                (nombre, categoria, descripcion, precio_unitario, precio_mayorista, archivado)
                VALUES (:nombre, :categoria, :descripcion, :precio_unitario, :precio_mayorista, :archivado)
            ");

            $query->execute([
                'nombre'          => $producto->getNombre(),
                'categoria'       => $producto->getCategoria(),
                'descripcion'     => $producto->getDescripcion(),
                'precio_unitario' => $producto->getPrecioUnitario(),
                'precio_mayorista'=> $producto->getPrecioMayorista(),
                'archivado'       => $producto->getArchivado()
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
                $query = $this->db->connect()->query("SELECT * FROM productos WHERE archivado = $option");
            } else {
                $query = $this->db->connect()->query("SELECT * FROM productos");
            }

            while ($row = $query->fetch()){
                $item = new Producto();
                $item->setIdProducto($row['id_producto']);
                $item->setNombre($row['nombre']);
                $item->setCategoria($row['categoria']);
                $item->setDescripcion($row['descripcion']);
                $item->setPrecioUnitario($row['precio_unitario']);
                $item->setPrecioMayorista($row['precio_mayorista']);
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
            $query = $this->db->connect()->prepare("SELECT * FROM productos WHERE id_producto = :id LIMIT 1");
            $query->execute(['id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row){
                $producto = new Producto();
                $producto->setIdProducto($row['id_producto']);
                $producto->setNombre($row['nombre']);
                $producto->setCategoria($row['categoria']);
                $producto->setDescripcion($row['descripcion']);
                $producto->setPrecioUnitario($row['precio_unitario']);
                $producto->setPrecioMayorista($row['precio_mayorista']);
                $producto->setArchivado($row['archivado']);

                return $producto;
            }
            return null;

        } catch (PDOException $e){
            return null;
        }
    }

    public function update(Producto $producto){
        try {
            $query = $this->db->connect()->prepare("
                UPDATE productos SET
                    nombre = :nombre,
                    categoria = :categoria,
                    descripcion = :descripcion,
                    precio_unitario = :precio_unitario,
                    precio_mayorista = :precio_mayorista
                WHERE id_producto = :id_producto
            ");

            $query->execute([
                'nombre'          => $producto->getNombre(),
                'categoria'       => $producto->getCategoria(),
                'descripcion'     => $producto->getDescripcion(),
                'precio_unitario' => $producto->getPrecioUnitario(),
                'precio_mayorista'=> $producto->getPrecioMayorista(),
                'id_producto'     => $producto->getIdProducto()
            ]);

            return true;

        } catch (PDOException $e){
            return false;
        }
    }

    public function hide($id_producto){
        try {
            $query = $this->db->connect()->prepare("
                UPDATE productos SET archivado = 1 WHERE id_producto = :id_producto
            ");
            $query->execute(['id_producto' => $id_producto]);
            return true;

        } catch (PDOException $e){
            return false;
        }
    }

    public function delete($id_producto){
        try {
            $query = $this->db->connect()->prepare("
                DELETE FROM productos WHERE id_producto = :id_producto
            ");
            $query->execute(['id_producto' => $id_producto]);
            return true;

        } catch (PDOException $e){
            return false;
        }
    }
}

?>
