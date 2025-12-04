<?php

class PresupuestoDetalleDAO extends Model {

    public function create(PresupuestoDetalle $d){
        $query = $this->db->connect()->prepare("
            INSERT INTO presupuesto_detalle 
                (id_presupuesto, id_producto, cantidad, precio_unitario, subtotal)
            VALUES (:id_presupuesto, :id_producto, :cantidad, :precio_unitario, :subtotal)
        ");

        return $query->execute([
            'id_presupuesto' => $d->getIdPresupuesto(),
            'id_producto'    => $d->getIdProducto(),
            'cantidad'       => $d->getCantidad(),
            'precio_unitario'=> $d->getPrecioUnitario(),
            'subtotal'       => $d->getSubtotal()
        ]);
    }

    public function find_by_presupuesto($id_presupuesto){
        $items = [];
        $query = $this->db->connect()->prepare("
            SELECT * FROM presupuesto_detalle WHERE id_presupuesto = :id
        ");
        $query->execute(['id'=>$id_presupuesto]);

        while($row = $query->fetch()){
            $d = new PresupuestoDetalle();
            $d->setIdDetalle($row['id_detalle']);
            $d->setIdPresupuesto($row['id_presupuesto']);
            $d->setIdProducto($row['id_producto']);
            $d->setCantidad($row['cantidad']);
            $d->setPrecioUnitario($row['precio_unitario']);
            $d->setSubtotal($row['subtotal']);
            $items[] = $d;
        }

        return $items;
    }

    public function delete($id_detalle){
        $query = $this->db->connect()->prepare("
            DELETE FROM presupuesto_detalle WHERE id_detalle = :id
        ");
        return $query->execute(['id' => $id_detalle]);
    }
}


?>