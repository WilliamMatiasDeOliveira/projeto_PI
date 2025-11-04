<?php

namespace App\Controllers;

use App\DAO\AtualizarDAO;

class AtualizarController
{

    public static function atualizar()
    {

        session_start();

        $dados = $_POST;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }

        if (isset($_SESSION['endereco'])) {
            $endereco = $_SESSION['endereco'];
        }
        
        $user['nome'] = $dados['nome'];
        $user['cpf'] = $dados['cpf'];
        $user['email'] = $dados['email'];
        $user['telefone'] = $dados['telefone'];

        unset($_SESSION['user']);
        $_SESSION['user'] = $user;

        $endereco['cep'] = $dados['cep'];
        $endereco['cidade'] = $dados['cidade'];
        $endereco['bairro'] = $dados['bairro'];
        $endereco['rua'] = $dados['rua'];

        unset($_SESSION['endereco']);
        $_SESSION['endereco'] = $endereco;

        $tabela = "";
        $id = "";

        if ($user['tipo'] === "cliente") {
            $tabela = "clientes";
            $id = $_SESSION['user']['id_cliente'];
        } else {
            $tabela = "cuidadores";
            $id = $_SESSION['user']['id_cuidador'];
        }

        $dados[] = $_SESSION['user'];
        $dados[] = $_SESSION['endereco'];

        $atualizarDAO = new AtualizarDAO();
        $atualizar = $atualizarDAO->atualizar($tabela, $id, $dados);

        if ($atualizar) {


            $_SESSION['update-success'] = "Seus dados foram atualizados !";

            if ($_SESSION['user']['tipo'] === "cliente") {
                header("Location: /projeto_PI/dashboard-cliente");
                exit;
            } else {
                header("Location: /projeto_PI/dashboard-cuidador");
                exit;
            }
        }
    }
}
