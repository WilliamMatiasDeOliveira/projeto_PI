<?php
namespace App\DAO;

use PDO;

class PasswordDAO extends Connection
{
    private $table = "clientes"; // ou "cuidadores", se for para cuidadores

    // Procura usuário pelo e-mail
    public function findUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Salva token de recuperação
    public function saveResetToken($email, $token)
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table}
            SET reset_token = :token,
                token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR)
            WHERE email = :email
        ");
        $stmt->bindValue(":token", $token);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
    }

    // Busca e-mail pelo token
    public function getEmailByToken($token)
    {
        $stmt = $this->pdo->prepare("
            SELECT email FROM {$this->table}
            WHERE reset_token = :token AND token_expiration > NOW()
        ");
        $stmt->bindValue(":token", $token);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['email'] : false;
    }

    // Atualiza senha
    public function updatePassword($email, $newPassword)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET senha = :senha WHERE email = :email");
        $stmt->bindValue(":senha", $newPassword);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
    }

    // Remove token após redefinição
    public function deleteToken($token)
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table} 
            SET reset_token = NULL, token_expiration = NULL 
            WHERE reset_token = :token
        ");
        $stmt->bindValue(":token", $token);
        $stmt->execute();
    }

    // Opcional: permite alterar a tabela (clientes ou cuidadores)
    public function setTable($table)
    {
        $this->table = $table;
    }
}
