<?php

use App\Controllers\AceitarRecusarController;
use App\Controllers\BuscarCuidadorController;
use App\Controllers\ClienteController;
use App\Controllers\CuidadorController;
use App\Controllers\EspecialidadeController;
use App\Controllers\ForgotPasswordController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\MainController;
use App\Controllers\PropostaController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = str_replace("/projeto_PI", "", $url);

switch ($url) {
    case "/":
    case "/home":
        MainController::home();
        break;
    case "/login":
        MainController::login();
        break;
    case "/login-submit":
        LoginController::login_submit();
        break;
    case "/form-cliente":
        MainController::form_cliente();
        break;
    case "/form-cliente-submit":
        ClienteController::form_cliente_submit();
        break;
    case "/form-cuidador":
        MainController::form_cuidador();
        break;
    case "/form-cuidador-submit":
        CuidadorController::form_cuidador_submit();
        break;
    case "/cadastro":
        MainController::cadastro();
        break;
    case "/sobre-nos":
        MainController::sobre_nos();
        break;
    case "/contatos":
        MainController::contatos();
        break;
    case "/dashboard-cliente":
        MainController::dashboard_cliente();
        break;
    case "/dashboard-cuidador":
        MainController::dashboard_cuidador();
        break;
    case "/logout":
        LogoutController::logout();
        break;
    case "/cad-especialidade":
        MainController::cad_especialidade();
        break;
    case "/cad-especialidade-submit":
        EspecialidadeController::cad_especialidade_submit();
        break;
    case "/buscar-cuidador":
        MainController::buscar_cuidador();
        break;
    case "/buscar-cuidador-submit":
        BuscarCuidadorController::buscar_cuidador_submit();
        break;
    case "/proposta":
        MainController::proposta();
        break;
    case "/enviar-proposta":
        PropostaController::enviar_proposta();
        break;
    case "/ver-propostas":
        MainController::ver_propostas();
        break;
    case "/listar-propostas":
        MainController::listar_propostas();
        break;
    case "/aceitar-recusar":
        AceitarRecusarController::AceitarRecusar();
        break;








    // ===========================================================
    // ROTAS EXCLUSIVAS PARA RECUPERAÇÃO DE SENHA
    // ===========================================================

    // Página com o campo de e-mail
    case "/forgot-password":
        MainController::forgot_password();
        break;

    //  Submissão do e-mail (envia o link)
    case "/forgot_password/send":
        ForgotPasswordController::forgot_password_submit();
        break;

    // Página para redefinir senha (acessada via token)
    case (preg_match("#^/reset-password/([a-zA-Z0-9]+)$#", $url, $matches) ? true : false):
        $_GET['token'] = $matches[1];
        MainController::reset_password();
        break;

    // Submissão da nova senha
    case "/reset-password-submit":
        ForgotPasswordController::reset_password_submit();
        break;
    default:
        echo "<h1>Página não encontrada (404)</h1>";
        break;
}
