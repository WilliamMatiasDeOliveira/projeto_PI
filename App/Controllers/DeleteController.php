<?php

namespace App\Controllers;

use App\DAO\DeleteDAO;

class DeleteController{

    public static function delete(){
        session_start();

        // verificar o tipo do usuario que esta nã sessão
        if($_SESSION['user']['tipo'] === "cliente"){
            $userId = $_SESSION['user']['id_cliente'];
            $tabela = "clientes";
            $coluna = "id_cliente";
        } else {
            $userId = $_SESSION['user']['id_cuidador'];
            $tabela = "cuidadores";
            $coluna = "id_cuidador";
        }

        $delete = new DeleteDAO();
        $resposta = $delete->delete($userId, $tabela, $coluna);

        if($resposta){
            $_SESSION['deletado_sucesso'] = "Sua conta foi excluida.";
            unset($_SESSION['user']);
            header("Location: /projeto_PI/home");
        }

    }
}