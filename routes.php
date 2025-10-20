<?php

use App\Controllers\MainController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = str_replace("/projeto_PI", "", $url);

switch($url){
    case "/":
    case "/home":
        MainController::home();
    break;
}