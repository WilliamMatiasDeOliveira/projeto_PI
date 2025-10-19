<?php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = str_replace("/projeto_PI", "", $url);

switch($url){
    
}