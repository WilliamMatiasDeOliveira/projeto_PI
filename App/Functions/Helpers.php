<?php

namespace App\Functions;

class Helpers{

    public static function cleanInput($value){
        return htmlspecialchars(strip_tags(stripslashes(trim(strtolower($value)))));
    }

}