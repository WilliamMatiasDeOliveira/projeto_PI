<?php

namespace App\Controllers;

class LogoutController{

    public static function logout(){
        session_start();
        unset($_SESSION['user']);
        header("Location: /projeto_PI/home");
        exit;
    }
}