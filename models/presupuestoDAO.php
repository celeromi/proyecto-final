<?php

class PresupuestoDAO extends Model {

    public function create(Presupuesto $p){
        $query = $this->db->connect()->prepare("
            INSERT INTO presupuestos (fecha, id_cliente, total, observaciones, archivado)
            VALUES (:fecha, :id_cliente, :total, :observaciones, :archivado)
        ");

        return $query->execute([
            'fecha'        => $p->getFecha(),
            'id_cliente'   => $p->getIdCliente(),
            'total'        => $p->getTotal(),
            'observaciones'=> $p->getObservaciones(),
            'archivado'    => $p->getArchivado()
        ]);
    }

    public function read($option){
        $items = [];
        
        $sql = ($option === 0 || $option === 1)
            ? "SELECT * FROM presupuestos WHERE archivado = $option"
            : "SELECT * FROM presupuestos";

        $query = $this->db->connect()->query($sql);

        while($row = $query->fetch()){
            $p = new Presupuesto();
            $p->setIdPresupuesto($row['id_presupuesto']);
            $p->setFecha($row['fecha']);
            $p->setIdCliente($row['id_cliente']);
            $p->setTotal($row['total']);
            $p->setObservaciones($row['observaciones']);
            $p->setArchivado($row['archivado']);

            $items[] = $p;
        }

        return $items;
    }

    public function find_id($id){
        $query = $this->db->connect()->prepare("
            SELECT * FROM presupuestos WHERE id_presupuesto = :id LIMIT 1
        ");
        $query->execute(['id' => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if(!$row) return null;

        $p = new Presupuesto();
        $p->setIdPresupuesto($row['id_presupuesto']);
        $p->setFecha($row['fecha']);
        $p->setIdCliente($row['id_cliente']);
        $p->setTotal($row['total']);
        $p->setObservaciones($row['observaciones']);
        $p->setArchivado($row['archivado']);
        return $p;
    }

    public function update(Presupuesto $p){
        $query = $this->db->connect()->prepare("
            UPDATE presupuestos SET
                fecha = :fecha,
                id_cliente = :id_cliente,
                total = :total,
                observaciones = :observaciones
            WHERE id_presupuesto = :id_presupuesto
        ");

        return $query->execute([
            'fecha'        => $p->getFecha(),
            'id_cliente'   => $p->getIdCliente(),
            'total'        => $p->getTotal(),
            'observaciones'=> $p->getObservaciones(),
            'id_presupuesto'=> $p->getIdPresupuesto()
        ]);
    }

    public function hide($id){
        $query = $this->db->connect()->prepare("
            UPDATE presupuestos SET archivado = 1 WHERE id_presupuesto = :id
        ");
        return $query->execute(['id' => $id]);
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("
            DELETE FROM presupuestos WHERE id_presupuesto = :id
        ");
        return $query->execute(['id'=>$id]);
    }
}

?>
