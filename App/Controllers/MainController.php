<?php

namespace App\Controllers;

class MainController{

    public static function home(){
        require_once __DIR__."/../Views/home.php";
    }
}