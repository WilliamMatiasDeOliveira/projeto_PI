<?php

namespace App\Controllers;

use App\DAO\GetAllSpecialitysDAO;

class GetAllSpecialitysController{

    public static function get_all_specialitys($user_id_cuidador){

        $GetAllSpecialitysDAO = new GetAllSpecialitysDAO();

        $especialidades = $GetAllSpecialitysDAO->get_all_specialitys_dao($user_id_cuidador);

        $_SESSION['all_specialitys'] = $especialidades;
        
    }
}