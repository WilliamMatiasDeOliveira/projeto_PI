<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DAO\AdicionarAvaliacaoDAO;

class LikeController
{
    public static function setar(): void
    {
        session_start();

        $id = (int) $_GET['id'];           // ID do usuário que recebeu avaliação
        $tipo = $_GET['tipo'];             // "g" ou "ng"
        $id_servico = $_SESSION['res'][0]['id_servico']; // serviço associado

        // Traduz tipo em like/deslike
        if ($tipo === 'g') {
            $like = 1;
            $deslike = 0;
        } else {
            $like = 0;
            $deslike = 1;
        }

        /* 
            >>> DEFININDO OS IDS  <<<

            Se o usuário logado for CLIENTE:
                Ele avalia o CUIDADOR (id vindo da URL)
                cliente_id  = id do cliente logado
                cuidador_id = id da URL

            Se for CUIDADOR:
                Ele avalia o CLIENTE (id vindo da URL)
                cuidador_id = id do cuidador logado
                cliente_id  = id da URL
        */

        if ($_SESSION['user']['tipo'] === "cliente") {

            $cliente_id  = $_SESSION['user']['id_cliente'];
            $cuidador_id = $id;

        } else {

            $cuidador_id = $_SESSION['user']['id_cuidador'];
            $cliente_id  = $id;
        }

        // Grava avaliação no banco
        $dao = new AdicionarAvaliacaoDAO();
        $dao->setarAvaliacao($like, $deslike, $cliente_id, $cuidador_id, $id_servico);

        echo "estou no likeController";
        die();
    }
}

