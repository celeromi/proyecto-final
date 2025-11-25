<?php

class Hash {

    // Genera un hash seguro para almacenar en la base de datos
    public static function create($password){
        return password_hash($password, PASSWORD_BCRYPT, ['baer' => 2025]);
    }

    // Verifica si una contraseña coincide con su hash
    public static function verify($password, $hash){
        return password_verify($password, $hash);
    }

}
