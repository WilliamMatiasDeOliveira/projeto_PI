<?php

namespace App\Controllers;

use App\DAO\ServicoDAO;
use App\Functions\MailHelper;
use PHPMailer\PHPMailer\PHPMailer;

session_start();

class PropostaController
{

    public static function enviar_proposta()
    {
        $id_cliente = $_SESSION['user']['id_cliente'];
        $id_cuidador = $_POST['id_cuidador'];
        $descricao = $_POST['descricao_paciente'];
        $periodo = $_POST['periodo'];
        $valor_proposta = $_POST['valor_proposta'];

        // criar uma intenção de serviço
        $servicoDAO  = new ServicoDAO();
        $servicoDAO->criar($id_cliente, $id_cuidador, $descricao, $valor_proposta);

        //    enviar email para o cuidador
        $emailData = $servicoDAO->getEmailCuidador($id_cuidador);
        $emailCuidador = $emailData['email'];

        // Corpo do e-mail em HTML
        $body = "
            <h3>Você recebeu uma nova proposta!</h3>
            <p><b>Descrição do paciente:</b> {$descricao}</p>
            <p><b>Período:</b> {$periodo}</p>
            <p><b>Valor:</b> R$ {$valor_proposta}</p>
            <p>Para aceitar ou recusar, acesse seu painel de cuidador.</p>
        ";

        $subject = "Nova proposta recebida - Sistema Conecte";

        // Chamando seu helper personalizado
        $enviado = MailHelper::sendMail($emailCuidador, $subject, $body);

        if (!$enviado) {
            $_SESSION['erro_envio_proposta'] = "Ocorreu um erro ao enviar o e-mail tente novamente !";
            header("Location: /projeto_PI/proposta");
            exit;
        }

        $_SESSION['sucesso_proposta_enviada'] = "Sua proposta foi enviada para o cuidador.";
        header("Location: /projeto_PI/buscar-cuidador");
        exit;
    }
}
