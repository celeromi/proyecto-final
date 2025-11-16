<?php

class LoginDAO extends Model {

    public function verifyCredentials($usuario, $contrasena) {
        try {
            $query = $this->db->connect()->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND archivado = 0");
            $query->execute(['usuario' => $usuario]);
            $row = $query->fetch();

            if ($row && password_verify($contrasena, $row['contrasena'])) {
                include_once 'models/usuario.php';
                $usuarioObj = new Usuario();
                $usuarioObj->setIdUsuario($row['id_usuario']);
                $usuarioObj->setNombre($row['nombre']);
                $usuarioObj->setApellido($row['apellido']);
                $usuarioObj->setUsuario($row['usuario']);
                return $usuarioObj;
            }
            return false;

        } catch (PDOException $e) {
            return false;
        }
    }
}
