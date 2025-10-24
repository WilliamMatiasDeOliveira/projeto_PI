<?php

namespace App\Controllers;

use App\DAO\LoginDAO;
use App\Functions\Helpers;
use App\Models\Login;

class LoginController
{

    public static function login_submit()
    {

        // verifica se houve uma requisição via post
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = Helpers::cleanInput($_POST['email']);
            $senha = $_POST['senha'];

            $erros = [];

            if (empty($email)) {
                $erros['email'] = "Preencha um E-mail";
            }
            if (empty($senha)) {
                $erros['senha'] = "Insira uma senha válida";
            }
            // cria duas sessões uma com o erro de imput vazio e outra com o old value do email
            if (!empty($erros)) {
                session_start();
                $_SESSION['erros'] = $erros;
                $old = [];
                $old['email'] = $email;
                $_SESSION['old'] = $old;
                // redireciona para a pagina login
                header("Location: /projeto_PI/login");
                exit;
            }


            $login = new Login();
            $login->setEmail($email);
            $login->setSenha($senha);

            $dao = new LoginDAO();

            // verifica se existe este usuario cadastrado no banco
            // se não existir redireciona para a pagina cadastro
            if (!$dao->login_submit_dao($login)) {
                session_start();
                $_SESSION['fail_login'] = "Para acessar o sistema crie sua conta gratis aqui !";
                // redireciona para a pagina login
                header("Location: /projeto_PI/cadastro");
                exit;
            }

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                if ($user['tipo'] === "cliente") {
                    header("Location: /projeto_PI/dashboard-cliente");
                    exit;
                } else {
                    header("Location: /projeto_PI/dashboard-cuidador");
                    exit;
                }
            }
        } //fim do if(request method)

    } // fim do metodo login_submit

}//fim da classe
