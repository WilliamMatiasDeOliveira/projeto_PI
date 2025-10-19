<?php
require __DIR__ . '/vendor/autoload.php'; // carrega o autoloader do Composer

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// carrega o arquivo de configuração com as constantes
require_once "config.php";
// carrega o spl_autoload_register
require_once "autoload.php";
// carrega o arquivo de roteamento
require_once "routes.php";
