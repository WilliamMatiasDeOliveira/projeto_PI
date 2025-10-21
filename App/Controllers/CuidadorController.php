<?php

namespace App\Controllers;

use App\DAO\CuidadorDAO;
use App\Functions\Helpers;
use App\Models\Cuidador;

class CuidadorController
{

    public static function form_cuidador_submit()
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
            header("Location: /projeto_PI/form-cuidador");
            exit;
        }

        // Verificar se este usuario ja existe verificando se este email ja foi cadastrado
        $dao = new CuidadorDAO();

        if (!$dao->checkIfClientExists($dados['email'])) {
            session_start();
            $erros['email_exists'] = "Este e-mail ja está em uso !";
            $_SESSION['erros'] = $erros;
            header("Location: /projeto_PI/form-cuidador");
            exit;
        }

        // Verificar se o campo senha e confirmar_senha são iguais
        if ($dados['senha'] !== $dados['confirmar_senha']) {
            session_start();
            $erros['confirmar_senha'] = "As senhas dever ser iguais !";
            $_SESSION['erros'] = $erros;
            header("Location: /projeto_PI/form-cuidador");
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
                header("Location: /projeto_PI/form-cuidador");
                exit;
            }
            // gera um nome unico para a foto
            $foto_nome = uniqid("cuidador_", true) . "." . $extensao;
            // montando o caminho de destino
            $destino = __DIR__ . "/../public/assets/imgs/cuidadores/" . $foto_nome;
            // verificando se a movimentação falhou
            if (!move_uploaded_file($foto_temp, $destino)) {
                session_start();
                $erros['fail_foto_saved'] = "Falha em salvar a foto";
                $_SESSION['erros'] = $erros;
                header("Location: /projeto_PI/form-cuidador");
                exit;
            }

            $dados['foto'] = $foto_nome;
        }

        // tratamento e movimentação do currículo
        $curriculo_nome = null;

        if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] === UPLOAD_ERR_OK) {
            // Caminho temporário do arquivo
            $curriculo_temp = $_FILES['curriculo']['tmp_name'];
            // Nome original
            $curriculo_nome_original = $_FILES['curriculo']['name'];
            // Extensão
            $extensao = strtolower(pathinfo($curriculo_nome_original, PATHINFO_EXTENSION));

            // Extensões aceitas
            $extensoes_permitidas = ['pdf', 'doc', 'docx'];

            if (!in_array($extensao, $extensoes_permitidas)) {
                session_start();
                $erros['curriculo_invalido'] = "Formato de currículo inválido. Envie um arquivo PDF, DOC ou DOCX.";
                $_SESSION['erros'] = $erros;
                header("Location: /projeto_PI/form-cuidador");
                exit;
            }

            // Gera um nome único para o currículo
            $curriculo_nome = uniqid("curriculo_", true) . "." . $extensao;

            // Caminho de destino
            $destino_curriculo = __DIR__ . "/../public/assets/imgs/curriculos/" . $curriculo_nome;

            // Move o arquivo
            if (!move_uploaded_file($curriculo_temp, $destino_curriculo)) {
                session_start();
                $erros['fail_curriculo_saved'] = "Falha ao salvar o currículo.";
                $_SESSION['erros'] = $erros;
                header("Location: /projeto_PI/form-cuidador");
                exit;
            }

            // Adiciona ao array de dados
            $dados['curriculo'] = $curriculo_nome;
        }

        // criando o objeto cuidador
        $cuidador = new Cuidador();
        $cuidador->setNome($dados['nome']);
        $cuidador->setCpf($dados['cpf']);
        $cuidador->setEmail($dados['email']);
        $cuidador->setTipo($dados['tipo']);
        $cuidador->setTelefone($dados['telefone']);
        $cuidador->setCep($dados['cep']);
        $cuidador->setRua($dados['rua']);
        $cuidador->setCidade($dados['cidade']);
        $cuidador->setBairro($dados['bairro']);
        $cuidador->setSenha($dados['senha']);
        $cuidador->setFoto($foto_nome);
        $cuidador->setCurriculo($curriculo_nome);

        // cadastra o cliente no banco de dados
        $dao->save($cuidador);

        // se o cliente for salvo com sucesso
        session_start();
        $success = "Sua conta de cuidador foi criada com sucesso !";
        $_SESSION['success'] = $success;
        header("Location: /projeto_PI/login");
        exit;
    }
}
