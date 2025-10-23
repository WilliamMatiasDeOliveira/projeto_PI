<?php

namespace App\Controllers;

use App\DAO\CheckEmail;
use App\DAO\ClienteDAO;
use App\Functions\Helpers;
use App\Models\Cliente;

class ClienteController
{

    public static function form_cliente_submit()
    {
        $dados = [
            "nome" => Helpers::cleanInput($_POST['nome']),
            "cpf" => Helpers::cleanInput($_POST['cpf']),
            "email" => Helpers::cleanInput($_POST['email']),
            "tipo" => Helpers::cleanInput($_POST['tipo']),
            "telefone" => Helpers::cleanInput($_POST['telefone']),
            "cep" => Helpers::cleanInput($_POST['cep']),
            "rua" => Helpers::cleanInput($_POST['rua']),
            "cidade" => Helpers::cleanInput($_POST['cidade']),
            "bairro" => Helpers::cleanInput($_POST['bairro']),
            "senha" => $_POST['senha'],
            "confirmar_senha" => $_POST['confirmar_senha'],
        ];

        // verificar se existe algum campo vazio (exceto o de foto)
        $erros = [];

        if (empty($dados['nome'])) {
            $erros['nome'] = "O campo nome é obrigatorio";
        }
        if (empty($dados['cpf'])) {
            $erros['cpf'] = "O campo cpf é obrigatorio";
        }
        if (empty($dados['email'])) {
            $erros['email'] = "O campo email é obrigatorio";
        }
        if (empty($dados['telefone'])) {
            $erros['telefone'] = "O campo telefone é obrigatorio";
        }
        if (empty($dados['cep'])) {
            $erros['cep'] = "O campo cep é obrigatorio";
        }
        if (empty($dados['rua'])) {
            $erros['rua'] = "O campo rua é obrigatorio";
        }
        if (empty($dados['cidade'])) {
            $erros['cidade'] = "O campo cidade é obrigatorio";
        }
        if (empty($dados['bairro'])) {
            $erros['bairro'] = "O campo bairro é obrigatorio";
        }
        if (empty($dados['senha'])) {
            $erros['senha'] = "O campo senha é obrigatorio";
        }
        if (empty($dados['confirmar_senha'])) {
            $erros['confirmar_senha'] = "O campo confirmar senha é obrigatorio";
        }

        // Se existir campos vazios retorna para o form-cliente exibindo os erros
        if (!empty($erros)) {
            session_start();
            $_SESSION['erros'] = $erros;

            $old = [
                "nome" => $_POST['nome'],
                "cpf" => $_POST['cpf'],
                "email" => $_POST['email'],
                "telefone" => $_POST['telefone'],
                "cep" => $_POST['cep'],
                "rua" => $_POST['rua'],
                "cidade" => $_POST['cidade'],
                "bairro" => $_POST['bairro'],
            ];
            $_SESSION['old'] = $old;
            header("Location: /projeto_PI/form-cliente");
            exit;
        }

        // Verificar se este email ja existe no bd verificando se este email ja foi cadastrado
        $check_email = new CheckEmail();

        if (!$check_email->checkIfEmailExists($dados['email'])) {
            session_start();
            $erros['email_exists'] = "Este e-mail ja está em uso !";
            $_SESSION['erros'] = $erros;

            $old = [
                "nome" => $_POST['nome'],
                "cpf" => $_POST['cpf'],
                "email" => $_POST['email'],
                "telefone" => $_POST['telefone'],
                "cep" => $_POST['cep'],
                "rua" => $_POST['rua'],
                "cidade" => $_POST['cidade'],
                "bairro" => $_POST['bairro'],
            ];
            $_SESSION['old'] = $old;
            header("Location: /projeto_PI/form-cliente");
            exit;
        }

        // Verificar se o campo senha e confirmar_senha são iguais
        if ($dados['senha'] !== $dados['confirmar_senha']) {
            session_start();
            $erros['confirmar_senha'] = "As senhas dever ser iguais !";
            $_SESSION['erros'] = $erros;

            $old = [
                "nome" => $_POST['nome'],
                "cpf" => $_POST['cpf'],
                "email" => $_POST['email'],
                "telefone" => $_POST['telefone'],
                "cep" => $_POST['cep'],
                "rua" => $_POST['rua'],
                "cidade" => $_POST['cidade'],
                "bairro" => $_POST['bairro'],
            ];
            $_SESSION['old'] = $old;
            header("Location: /projeto_PI/form-cliente");
            exit;
        }

        // tratamento e movimentação da foto
        $foto_nome = null;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // pegando o caminho temporario
            $foto_temp = $_FILES['foto']['tmp_name'];
            // pega o nome original
            $foto_nome_original = $_FILES['foto']['name'];
            // pegar a extenssão da foto
            $extensao = pathinfo($foto_nome_original, PATHINFO_EXTENSION);
            // força a extensão a ter letras pequenas
            $extensao = strtolower($extensao);
            // verifica se a extensão é de um formato aceitavel
            if ($extensao !== "jpg" && $extensao !== "jpeg" && $extensao !== "png") {
                session_start();
                $erros['foto_invalida'] = "Formato inválido";
                $_SESSION['erros'] = $erros;

                $old = [
                    "nome" => $_POST['nome'],
                    "cpf" => $_POST['cpf'],
                    "email" => $_POST['email'],
                    "telefone" => $_POST['telefone'],
                    "cep" => $_POST['cep'],
                    "rua" => $_POST['rua'],
                    "cidade" => $_POST['cidade'],
                    "bairro" => $_POST['bairro'],
                ];
                $_SESSION['old'] = $old;
                header("Location: /projeto_PI/form-cliente");
                exit;
            }
            // gera um nome unico para a foto
            $foto_nome = uniqid("cliente_", true) . "." . $extensao;
            // montando o caminho de destino
            $destino = __DIR__ . "/../public/assets/imgs/clientes/" . $foto_nome;
            // verificando se a movimentação falhou
            if (!move_uploaded_file($foto_temp, $destino)) {
                session_start();
                $erros['fail_foto_saved'] = "Falha em salvar a foto";
                $_SESSION['erros'] = $erros;

                $old = [
                    "nome" => $_POST['nome'],
                    "cpf" => $_POST['cpf'],
                    "email" => $_POST['email'],
                    "telefone" => $_POST['telefone'],
                    "cep" => $_POST['cep'],
                    "rua" => $_POST['rua'],
                    "cidade" => $_POST['cidade'],
                    "bairro" => $_POST['bairro'],
                ];
                $_SESSION['old'] = $old;
                header("Location: /projeto_PI/form-cliente");
                exit;
            }

            $dados['foto'] = $foto_nome;
        }



        // criando o objeto cliente
        $cliente = new Cliente();
        $cliente->setNome($dados['nome']);
        $cliente->setCpf($dados['cpf']);
        $cliente->setEmail($dados['email']);
        $cliente->setTipo($dados['tipo']);
        $cliente->setTelefone($dados['telefone']);
        $cliente->setCep($dados['cep']);
        $cliente->setRua($dados['rua']);
        $cliente->setCidade($dados['cidade']);
        $cliente->setBairro($dados['bairro']);
        $cliente->setSenha($dados['senha']);
        $cliente->setFoto($foto_nome);

        $dao = new ClienteDAO();

        // cadastra o cliente no banco de dados
        $dao->save($cliente);

        // se o cliente for salvo com sucesso
        session_start();
        $success = "Sua conta de cliente foi criada com sucesso !";
        $_SESSION['success'] = $success;
        header("Location: /projeto_PI/login");
        exit;
    }
}
