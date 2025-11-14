<?php

namespace App\Controllers;

use App\DAO\BuscarEstatusDAO;

class CarregarHistoricoController
{

    public static function carregarHistorico()
    {

        session_start();

        if ($_SESSION['user']['tipo'] === "cliente") {
            $id = $_SESSION['user']['id_cliente'];
        } else {
            $id = $_SESSION['user']['id_cuidador'];
        }


        // faz um select na tabela servicos e busca o estatus = a "aceito"
        $buscarEstatus = new BuscarEstatusDAO();
        // no $res eu tenho todos os serviços fechados pelo usuario cliente/cuidador
        // onde cada posição do array é um servico fechado
        $res = $buscarEstatus->buscarEstatus($id);
        /*
                conteudo de res
         Array
(
    [0] => Array
        (
            [id_servico] => 1
            [data_inicio] => 2025-11-13
            [data_fim] => 
            [estatus] => aceito
            [descricao_paciente] => proposta teste
            [valor_proposta] => 200.00
            [cliente_id] => 1
            [cuidador_id] => 2
        )

) 
         */


        $_SESSION['res'] = $res;

        header("Location: /projeto_PI/exibir-historico");
        exit();
    }
}
