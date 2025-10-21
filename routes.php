<?php

use App\Controllers\ClienteController;
use App\Controllers\MainController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = str_replace("/projeto_PI", "", $url);

switch($url){
    case "/":
    case "/home":
        MainController::home();
    break;
    case "/login":
        MainController::login();
        break;
    case "/form-cliente":
        MainController::form_cliente();
    break;
    case "/form-cliente-submit":
        ClienteController::form_cliente_submit();
    break;
}