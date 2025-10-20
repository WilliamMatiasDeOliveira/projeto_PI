<?php

namespace App\Controllers;

use App\Functions\Helpers;

class ClienteController{

    public static function form_cliente_submit(){
        $nome = Helpers::cleanInput($_POST['nome']);
        $cpf = Helpers::cleanInput($_POST['cpf']);
        $email = Helpers::cleanInput($_POST['email']);
        $telefone =Helpers::cleanInput($_POST['telefone']);
        $cep = Helpers::cleanInput($_POST['cep']);
        $rua = Helpers::cleanInput($_POST['rua']);
        $cidade = Helpers::cleanInput($_POST['cidade']);
        $bairro = Helpers::cleanInput($_POST['bairro']);
        $foto = Helpers::cleanInput($_POST['foto']);

        // verificar se existe algum campo vazio (exceto o de foto)
        $erros = [];

        if(empty($nome)){
            $erros['nome'] = "O campo nome é obrigatorio";
        }
    }
}