<?php

class Session {

    public function __construct(){
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function exists($key){
        return isset($_SESSION[$key]);
    }

    public function close(){
        session_unset();
        session_destroy();
    }
}
