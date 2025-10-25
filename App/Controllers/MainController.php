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

    public static function forgot_password(){
        require_once VIEWS."/forgot_password.php";
    }

    public static function reset_password(){
        require_once VIEWS."/reset_password.php";
    }

    public static function cadastro(){
        require_once VIEWS."/cadastro.php";
    }

    public static function sobre_nos(){
        require_once VIEWS."/sobre-nos.php";
    }

    public static function contatos(){
        require_once VIEWS."/contatos.php";
    }

    public static function dashboard_cliente(){
        require_once VIEWS."/dashboard-cliente.php";
    }

    public static function dashboard_cuidador(){
        require_once VIEWS."/dashboard-cuidador.php";
    }

    public static function cad_especialidade(){
        require_once VIEWS."/cad-especialidade.php";
    }










    public static function buscar_cuidador(){
        require_once VIEWS."/buscar-cuidador.php";
    }
}