<?php

namespace App\Controllers;

use App\DAO\AtualizarDAO;

class AtualizarController
{

    public static function atualizar_submit()
    {

        session_start();

        $dados = $_POST;

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
                header("Location: /projeto_PI/atualizar");
                exit;
            }
            // gera um nome unico para a foto
            if ($dados['tipo'] === "cliente") {
                $foto_nome = uniqid("cliente_", true) . "." . $extensao;
                // montando o caminho de destino
                $destino = __DIR__ . "/../public/assets/imgs/clientes/" . $foto_nome;
            } else {
                $foto_nome = uniqid("cuidador_", true) . "." . $extensao;
                // montando o caminho de destino
                $destino = __DIR__ . "/../public/assets/imgs/cuidadores/" . $foto_nome;
            }

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

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }

        if (isset($_SESSION['endereco'])) {
            $endereco = $_SESSION['endereco'];
        }

        if ($user['tipo'] === "cuidador") {
            // tratamento e movimentação de curriculo
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
                    $_SESSION['old'] = $_POST;
                    header("Location: /projeto_PI/atualizar");
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
                    $_SESSION['old'] = $_POST;
                    header("Location: /projeto_PI/form-cuidador");
                    exit;
                }

                // Adiciona ao array de dados
                $dados['curriculo'] = $curriculo_nome;
            }
        }

        $tipo = "";
        if ($user['tipo'] === "cliente") {
            $tabela = "clientes";
            $user['id_cliente'] = $user['id_cliente'];
            $id = $user['id_cliente'];
            $tipo = "cliente";
        } else {
            $tabela = "cuidadores";
            $user['id_cuidador'] = $user['id_cuidador'];
            $id = $user['id_cuidador'];
            $tipo = "cuidador";
        }

        $user['nome'] = $dados['nome'];
        $user['cpf'] = $dados['cpf'];
        $user['email'] = $dados['email'];
        $user['telefone'] = $dados['telefone'];
        $user['foto'] = $foto_nome ?? $_SESSION['user']['foto']; // mantém a antiga se não houver nova
        $user['tipo'] = $tipo;

        if ($user['tipo'] === "cuidador") {
            $user['curriculo'] = $_SESSION['user']['curriculo'];
        }

        unset($_SESSION['user']);
        $_SESSION['user'] = $user;

        $endereco = [];
        $endereco['cep'] = $dados['cep'];
        $endereco['cidade'] = $dados['cidade'];
        $endereco['bairro'] = $dados['bairro'];
        $endereco['rua'] = $dados['rua'];

        unset($_SESSION['endereco']);
        $_SESSION['endereco'] = $endereco;

        $atualizarDAO = new AtualizarDAO();
        $atualizar = $atualizarDAO->atualizar($tabela, $id);


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
