<?php

namespace App\Controllers;

use App\DAO\AtualizarDAO;
use App\DAO\AtualizarFotoDAO;

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

    public static function atualizarFoto()
    {
        if (
            isset($_FILES['foto']) && 
            isset($_POST['tipo']) && 
            in_array($_POST['tipo'], ['cuidador', 'cliente'])
        ) {

            $tipo = $_POST['tipo'];

            if ($tipo == 'cuidador') {
                $caminhoTipo = 'cuidadores';
            } else {
                $caminhoTipo = 'clientes';
            }

            // Define o diretório de destino (relative à pasta public)
            $diretorioFinal = __DIR__ . "/../public/assets/imgs/{$caminhoTipo}/";

            // Gera um nome único para o arquivo
            $arquivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
            $caminho = $diretorioFinal . $arquivo;

            // Extensões permitidas
            $tipoArquivo = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($tipoArquivo, $allowedTypes)) {
                // Move o arquivo para o diretório final
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho)) {

                    // Caminho relativo que será salvo no banco (para exibir via <img>)
                    $caminhoDB = "/assets/imgs/{$caminhoTipo}/" . $arquivo;

                    // Atualiza no banco de dados
                    $atualizarFotoDAO = new AtualizarFotoDAO();
                    $atualizado = $atualizarFotoDAO->atualizar($tipo, $caminhoDB, $_SESSION['user']['id']);

                    if ($atualizado) {
                        session_start();
                        $_SESSION['user']['foto'] = $caminhoDB;

                        if ($tipo == 'cliente') {
                            header('Location: /projeto_PI/dashboard-cliente');
                        } else {
                            header('Location: /projeto_PI/dashboard-cuidador');
                        }

                    } else {
                        echo "Erro ao atualizar o banco de dados.";
                    }

                } else {
                    echo "Erro ao mover o arquivo.";
                }
            } else {
                echo "Tipo de arquivo não permitido.";
            }
        } else {
            echo "Nenhum arquivo enviado ou tipo inválido.";
        }
    }
}
