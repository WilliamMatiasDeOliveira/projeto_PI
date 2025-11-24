<?php
namespace App\Controllers;

use App\DAO\PasswordDAO;
use App\Functions\MailHelper;

class ForgotPasswordController
{
    /**
     * ================================================================
     * PROCESSA O FORMULÁRIO "ESQUECEU A SENHA"
     * rota: /forgot-password-submit
     * ================================================================
     */
    public static function forgot_password_submit()
    {
        session_start();
        $email = trim($_POST['email'] ?? '');

        if (empty($email)) {
            $_SESSION['error'] = "Por favor, informe seu e-mail.";
            header("Location: /projeto_PI/forgot-password");
            exit;
        }

        $dao = new PasswordDAO();
        $user = $dao->findUserByEmail($email);

        if (!$user) {
            $_SESSION['error'] = "E-mail não encontrado.";
            header("Location: /projeto_PI/forgot-password");
            exit;
        }

        // Gera token seguro e salva no banco
        $token = bin2hex(random_bytes(50));
        $dao->saveResetToken($email, $token);



        // Monta link com token
        $resetLink = "http://localhost/projeto_PI/reset-password/$token";

        // Monta conteúdo do e-mail
        $subject = "Redefinição de Senha - Conecte";
        $body = "
            <h3>Olá, {$user['nome']}!</h3>
            <p>Recebemos uma solicitação para redefinir sua senha.</p>
            <p>Clique no link abaixo para criar uma nova senha:</p>
            <p><a href='$resetLink'>$resetLink</a></p>
            <p>Se você não fez esta solicitação, ignore este e-mail.</p>
        ";

        // Envia o e-mail
        $enviado = MailHelper::sendMail($email, $subject, $body);

        if ($enviado) {
            $_SESSION['success'] = "Um link de redefinição foi enviado para seu e-mail.";
            header("Location: /projeto_PI/login");
        } else {
            $_SESSION['error'] = "Erro ao enviar o e-mail. Tente novamente mais tarde.";
            header("Location: /projeto_PI/forgot-password");
        }
        exit;
    }

    /**
     * ================================================================
     * EXIBE A VIEW DE REDEFINIÇÃO DE SENHA (ACESSADA VIA TOKEN)
     * rota: /reset-password/{token}
     * ================================================================
     */
    public static function reset_password_form()
    {
        session_start();
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            $_SESSION['error'] = "Token inválido.";
            header("Location: /projeto_PI/forgot-password");
            exit;
        }

        require_once "App/Views/reset_password.php";
    }

    /**
     * ================================================================
     * PROCESSA A NOVA SENHA
     * rota: /reset-password-submit
     * ================================================================
     */
    public static function reset_password_submit()
    {
        session_start();
        $token = $_POST['token'] ?? '';
        $newPassword = $_POST['senha'] ?? '';
        $confirmPassword = $_POST['confirmar_senha'] ?? '';

        if (empty($token) || empty($newPassword) || empty($confirmPassword)) {
            $_SESSION['error'] = "Preencha todos os campos.";
            header("Location: /projeto_PI/reset-password/$token");
            exit;
        }

        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = "As senhas não conferem.";
            header("Location: /projeto_PI/reset-password/$token");
            exit;
        }

        $dao = new PasswordDAO();
        $email = $dao->getEmailByToken($token);

        if (!$email) {
            $_SESSION['error'] = "Token inválido ou expirado.";
            header("Location: /projeto_PI/forgot-password");
            exit;
        }

        // Criptografa e atualiza a senha
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $dao->updatePassword($email, $hashedPassword);
        $dao->deleteToken($token);

        $_SESSION['success'] = "Senha redefinida com sucesso! Faça login.";
        header("Location: /projeto_PI/login");
        exit;
    }
}
