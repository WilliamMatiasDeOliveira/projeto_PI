<?php

namespace App\Controllers;

session_start();

use App\DAO\GetAddressToUserInSession;
use App\DAO\GetNameByIdDAO;
use App\DAO\ServicoDAO;
use App\DAO\VerPropostaDAO;

class MainController
{

    public static function home()
    {
        require_once __DIR__ . "/../Views/home.php";
    }

    public static function login()
    {
        require_once VIEWS . "/login.php";
    }

    public static function form_cliente()
    {
        require_once VIEWS . "/form-cliente.php";
    }

    public static function form_cuidador()
    {
        require_once VIEWS . "/form-cuidador.php";
    }

    public static function cadastro()
    {
        require_once VIEWS . "/cadastro.php";
    }

    public static function sobre_nos()
    {
        require_once VIEWS . "/sobre-nos.php";
    }

    public static function contatos()
    {
        require_once VIEWS . "/contatos.php";
    }

    public static function dashboard_cliente()
    {
        require_once VIEWS . "/dashboard-cliente.php";
    }

    public static function dashboard_cuidador()
    {

        $servicoDAO = new ServicoDAO();
        $novasPropostas = $servicoDAO->buscarPendentesPorCuidador($_SESSION['user']['id_cuidador']);

        $_SESSION['novas_propostas'] = $novasPropostas;

        require_once VIEWS . "/dashboard-cuidador.php";
    }

    public static function cad_especialidade()
    {
        require_once VIEWS . "/cad-especialidade.php";
    }

    public static function buscar_cuidador()
    {
        require_once VIEWS . "/buscar-cuidador.php";
    }

    public static function proposta()
    {
        require_once VIEWS . "/proposta.php";
    }

    public static function ver_propostas()
    {

        $verPropostaDAO = new VerPropostaDAO();
        $propostas_pendente = $verPropostaDAO->buscar_propostas($_SESSION['user']['id_cuidador']);

        $nome_clientes = [];

        foreach ($propostas_pendente as $proposta) {
            $nome_clientes[] = $proposta['cliente_id'];
        }

        if (empty($nome_clientes)) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        $nomes = [];
        foreach ($nome_clientes as $cliente) {
            $buscarNomesPorId = new GetNameByIdDAO();
            // aki esta sendo feita a converssão de cliente_id pelo nome do cliente
            $nomes[] = $buscarNomesPorId->getNameById($cliente);
        }

        $_SESSION['nomes'] = $nomes;
        $_SESSION['propostas'] = $propostas_pendente;

        header("Location: /projeto_PI/listar-propostas");
        exit;
    }

    public static function listar_propostas()
    {
        require_once VIEWS . "/listar-propostas.php";
    }

    public static function atualizar()
    {
        require_once VIEWS . "/atualizar.php";
    }



    // //////////////////////////////////////////////////////////
    // Metodos exclisivos para recuperação de senha
    // /////////////////////////////////////////////////////////

    public static function forgot_password()
    {
        require_once VIEWS . "/forgot_password.php";
    }

    public static function reset_password()
    {
        require_once VIEWS . "/reset_password.php";
    }
}
