<?php

include_once 'models/presupuestoDetalle.php';

class PresupuestoDetalleDAO extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function create(PresupuestoDetalle $detalle){
        try {
            $query = $this->db->connect()->prepare("
                INSERT INTO detalle_presupuesto
                (id_presupuesto, id_producto, cantidades, archivado)
                VALUES (:id_presupuesto, :id_producto, :cantidades, :archivado)
            ");

            $query->execute([
                'id_presupuesto' => $detalle->getIdPresupuesto(),
                'id_producto'    => $detalle->getIdProducto(),
                'cantidades'     => $detalle->getCantidades(),
                'archivado'      => $detalle->getArchivado()
            ]);

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function read($option){
        $items = [];

        try {
            if ($option == 0 || $option == 1) {
                $query = $this->db->connect()->query("
                    SELECT * FROM detalle_presupuesto WHERE archivado = $option
                ");
            } else {
                $query = $this->db->connect()->query("SELECT * FROM detalle_presupuesto");
            }

            while ($row = $query->fetch()){
                $item = new PresupuestoDetalle();
                $item->setIdDetalle($row['id_detalles_presupuesto']);
                $item->setIdPresupuesto($row['id_presupuesto']);
                $item->setIdProducto($row['id_producto']);
                $item->setCantidades($row['cantidades']);
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
            $query = $this->db->connect()->prepare("SELECT * FROM detalle_presupuesto WHERE id_detalle = :id LIMIT 1");
            $query->execute(['id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row){
                $detalle = new PresupuestoDetalle();
                $detalle->setIdDetalle($row['id_detalles_presupuesto']);
                $detalle->setIdPresupuesto($row['id_presupuesto']);
                $detalle->setIdProducto($row['id_producto']);
                $detalle->setCantidades($row['cantidades']);
                $detalle->setArchivado($row['archivado']);

                return $detalle;
            }

            return null;

        } catch (PDOException $e){
            return null;
        }
    }

    public function find_by_presupuesto($id_presupuesto){
        $items = [];

        try {
            $query = $this->db->connect()->prepare("SELECT * FROM detalle_presupuesto WHERE id_presupuesto = :id_presupuesto AND archivado = 0");
            $query->execute(['id_presupuesto' => $id_presupuesto]);

            while ($row = $query->fetch()){
                $item = new PresupuestoDetalle();
                $item->setIdDetalle($row['id_detalles_presupuesto']);
                $item->setIdPresupuesto($row['id_presupuesto']);
                $item->setIdProducto($row['id_producto']);
                $item->setCantidades($row['cantidades']);
                $item->setArchivado($row['archivado']);

                array_push($items, $item);
            }

            return $items;

        } catch (PDOException $e){
            return [];
        }
    }

    public function update(PresupuestoDetalle $detalle){
        try {
            $query = $this->db->connect()->prepare("
                UPDATE detalle_presupuesto SET
                    id_presupuesto = :id_presupuesto,
                    id_producto    = :id_producto,
                    cantidades     = :cantidades
                WHERE id_detalle = :id_detalle
            ");

            $query->execute([
                'id_presupuesto' => $detalle->getIdPresupuesto(),
                'id_producto'    => $detalle->getIdProducto(),
                'cantidades'     => $detalle->getCantidades(),
                'id_detalle'     => $detalle->getIdDetalle()
            ]);

            return true;

        } catch (PDOException $e){
            return false;
        }
    }

    public function hide($id){
        try {
            $query = $this->db->connect()->prepare("UPDATE detalle_presupuesto SET archivado = 1 WHERE id_detalles_presupuesto = :id");
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e){
            return false;
        }
    }

    public function delete($id){
        try {
            $query = $this->db->connect()->prepare("DELETE FROM detalle_presupuesto WHERE id_detalles_presupuesto = :id");
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e){
            return false;
        }
    }

}

?>
