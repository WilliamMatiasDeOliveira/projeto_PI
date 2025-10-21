<?php

namespace App\Controllers;

class MainController{

    public static function home(){
        require_once __DIR__."/../Views/home.php";
    }

    public static function login(){
        require_once VIEWS."/login.php";
    }

    public static function form_cliente(){
        require_once VIEWS."/form-cliente.php";
    }

    public static function form_cuidador(){
        require_once VIEWS."/form-cuidador.php";
    }
}