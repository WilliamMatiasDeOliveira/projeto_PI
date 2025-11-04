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

        if($novo_status === "aceito"){
            $novo_status = "Aceita";
        } else {
            $novo_status = "Recusada";
        }

        $buscarEmailClienteDAO = new BuscarEmailClienteDAO();
        $emailCliente = $buscarEmailClienteDAO->buscarEmailCliente($cliente_id);

        session_start();
        $user = $_SESSION['user'];

        $telefone = Helpers::formatarTelefone($user['telefone']);


        // Corpo do e-mail em HTML
        if($acao === "aceitar"){
            $body = "
                <h3><b>A sua proposta foi {$novo_status}</b></h3>
                <p><b>Entre em contato com cuidador para acertar os detalhes do serviço</b></p>
                <p><b>Email: {$user['email']}</b></p>
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
        } else {
            $body = "
                <h3><b>A sua proposta foi {$novo_status}</b></h3>
                <p><b>Tente outro cuidador na nossa plataforma !</b></p>
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
}
