<?php

namespace App\Controllers;

use App\DAO\AceitarRecusarDAO;
use App\DAO\BuscarEmailClienteDAO;
use App\Functions\Helpers;
use App\Functions\MailHelper;

class AceitarRecusarController
{
    public static function AceitarRecusar()
    {
        $acao = $_POST['acao'];
        $servico = $_POST['id_proposta'];
        $cliente_id = $_POST['cliente_id'];

        if ($acao === "aceitar") {
            $novo_status = "aceito";
        } else {
            $novo_status = "recusado";
        }

        $aceitarRecusarDAO = new AceitarRecusarDAO();
        $aceitarRecusarDAO->mudar_status($novo_status, $servico);

        $buscarEmailClienteDAO = new BuscarEmailClienteDAO();
        $emailCliente = $buscarEmailClienteDAO->buscarEmailCliente($cliente_id);

        // print_r($emailCliente['email']);
        // die();

        session_start();
        $user = $_SESSION['user'];

        $telefone = Helpers::formatarTelefone($user['telefone']);


        // Corpo do e-mail em HTML
        $body = "
            <h3><b>A sua proposta foi {$novo_status}</b></h3>
            <p><b>Entre em contato com ele para acertar os detalhes do serviço</b></p>
            <p><b>Email: {$emailCliente['email']}</b></p>
            <p><b>Telefone: {$telefone}</b></p>
        ";

        $subject = "Nova resposta recebida - Sistema Conecte";

        $enviado = MailHelper::sendMail($emailCliente['email'], $subject, $body);

        if (!$enviado) {
            $_SESSION['erro_envio_resposta'] = "Ocorreu um erro ao enviar o e-mail tente novamente!";
        } else {
            $_SESSION['sucesso_resposta_enviada'] = "Sua resposta foi enviada para o cliente.";
        }

        header("Location: /projeto_PI/dashboard-cuidador");
        exit;
    }
}
