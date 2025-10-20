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
        $senha = $_POST['senha'];
        $confirmar_senha = $_POST['confirmar_senha'];

        // verificar se existe algum campo vazio (exceto o de foto)
        $erros = [];

        if(empty($nome)){
            $erros['nome'] = "O campo nome é obrigatorio";
        }
        if(empty($cpf)){
            $erros['cpf'] = "O campo cpf é obrigatorio";
        }
        if(empty($email)){
            $erros['email'] = "O campo email é obrigatorio";
        }
        if(empty($telefone)){
            $erros['telefone'] = "O campo telefone é obrigatorio";
        }
        if(empty($cep)){
            $erros['cep'] = "O campo cep é obrigatorio";
        }
        if(empty($rua)){
            $erros['rua'] = "O campo rua é obrigatorio";
        }
        if(empty($cidade)){
            $erros['cidade'] = "O campo cidade é obrigatorio";
        }
        if(empty($bairro)){
            $erros['bairro'] = "O campo bairro é obrigatorio";
        }
        if(empty($senha)){
            $erros['senha'] = "O campo senha é obrigatorio";
        }
        if(empty($confirmar_senha)){
            $erros['confirmar_senha'] = "O campo confirmar senha é obrigatorio";
        }

        // Se existir campos vazios retorna para o form-cliente exibindo os erros
        if(!empty($erros)){
            session_start();
            $_SESSION['erros'] = $erros;
            header("Location: /projeto_PI/form-cliente");
            exit;
        }




    }








}