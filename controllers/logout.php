<?php

class Logout extends Controller {

    function __construct() {
        parent::__construct();
        include_once 'libs/session.php';
        $session = new Session();
        $session->close();
        header('Location: '.constant('URL').'login');
    }
}
