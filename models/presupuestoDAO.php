<?php

include_once 'models/presupuesto.php';

class PresupuestoDAO extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function create(Presupuesto $presupuesto){
        try {
            $query = $this->db->connect()->prepare("
                INSERT INTO presupuestos 
                (id_usuario, id_cliente, fecha, estado, importe_final, archivado)
                VALUES (:id_usuario, :id_cliente, :fecha, :estado, :importe_final, :archivado)
            ");

            $query->execute([
                'id_usuario'    => $presupuesto->getIdUsuario(),
                'id_cliente'    => $presupuesto->getIdCliente(),
                'fecha'         => $presupuesto->getFecha(),
                'estado'        => $presupuesto->getEstado(),
                'importe_final' => $presupuesto->getImporteFinal(),
                'archivado'     => $presupuesto->getArchivado()
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
                $query = $this->db->connect()->query("SELECT * FROM presupuestos WHERE archivado = $option");
            } else {
                $query = $this->db->connect()->query("SELECT * FROM presupuestos");
            }

            while ($row = $query->fetch()){
                $item = new Presupuesto();
                $item->setIdPresupuesto($row['id_presupuesto']);
                $item->setIdUsuario($row['id_usuario']);
                $item->setIdCliente($row['id_cliente']);
                $item->setFecha($row['fecha']);
                $item->setEstado($row['estado']);
                $item->setImporteFinal($row['importe_final']);
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
            $query = $this->db->connect()->prepare("SELECT * FROM presupuestos WHERE id_presupuesto = :id LIMIT 1");
            $query->execute(['id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row){
                $presupuesto = new Presupuesto();
                $presupuesto->setIdPresupuesto($row['id_presupuesto']);
                $presupuesto->setIdUsuario($row['id_usuario']);
                $presupuesto->setIdCliente($row['id_cliente']);
                $presupuesto->setFecha($row['fecha']);
                $presupuesto->setEstado($row['estado']);
                $presupuesto->setImporteFinal($row['importe_final']);
                $presupuesto->setArchivado($row['archivado']);

                return $presupuesto;
            }
            return null;

        } catch (PDOException $e){
            return null;
        }
    }

    public function update(Presupuesto $presupuesto){
        try {
            $query = $this->db->connect()->prepare("
                UPDATE presupuestos SET
                    id_usuario = :id_usuario,
                    id_cliente = :id_cliente,
                    fecha = :fecha,
                    estado = :estado,
                    importe_final = :importe_final
                WHERE id_presupuesto = :id_presupuesto
            ");

            $query->execute([
                'id_usuario'    => $presupuesto->getIdUsuario(),
                'id_cliente'    => $presupuesto->getIdCliente(),
                'fecha'         => $presupuesto->getFecha(),
                'estado'        => $presupuesto->getEstado(),
                'importe_final' => $presupuesto->getImporteFinal(),
                'id_presupuesto'=> $presupuesto->getIdPresupuesto()
            ]);

            return true;

        } catch (PDOException $e){
            return false;
        }
    }

    public function hide($id){
        try {
            $query = $this->db->connect()->prepare("UPDATE presupuestos SET archivado = 1 WHERE id_presupuesto = :id");
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e){
            return false;
        }
    }

    public function delete($id){
        try {
            $query = $this->db->connect()->prepare("DELETE FROM presupuestos WHERE id_presupuesto = :id");
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e){
            return false;
        }
    }

    public function last_insert_id(){
        try {
            $query = $this->db->connect()->query("SELECT LAST_INSERT_ID() AS id");
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['id'] ?? null;
        } catch (PDOException $e){
            error_log("PresupuestoDAO::last_insert_id -> ".$e->getMessage());
            return null;
        }
    }

    public function update_status($id, $estado){
        try {
            $query = $this->db->connect()->prepare("UPDATE presupuestos SET estado = '".$estado."' WHERE id_presupuesto = :id");
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e){
            return false;
        }
    }


}

?>
