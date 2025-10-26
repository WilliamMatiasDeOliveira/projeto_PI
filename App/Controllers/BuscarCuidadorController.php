<?php

namespace App\Controllers;

use App\DAO\BuscarCuidadorDAO;

class BuscarCuidadorController
{
    public static function buscar_cuidador_submit()
    {
        session_start();
        // pegar o name do botão clicado
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $search = $_POST['especialidade'];

            $buscarCuidadorDAO = new BuscarCuidadorDAO();
            $cuidadores = $buscarCuidadorDAO->buscar_por_especialidade($search);

            // se não houver cuidador cadastrado com a especialidade
            // retorna uma menssagem para a pagina buscar-cuidador.php
            if (!$cuidadores) {
                $_SESSION['not_exists_cuidador_with_especiality'] = "Não existe cuidadores cadastrado com essa especialidade !";
                header("Location: /projeto_PI/buscar-cuidador");
                exit;
            }

            // se houver cuidadores com a especialidade buscada
            // retorna eles em um array associativo atraves da session
            $_SESSION['cuidadores'] = $cuidadores;
            header("Location: /projeto_PI/buscar-cuidador");
            exit;











            // $cuidadores = [];
            // switch($search){
            //     case "banho":
            //         echo "vc digitou ". $search;
            //         break;
            //     case "curativo":
            //         echo "vc digitou curativo";
            //         break;
            //     case "diaria":
            //         echo "vc digitou diaria";
            //         break;
            //     case "pernoite":
            //         echo "vc digitou pernoite";
            //         break;

            // }
        }
    }
}
