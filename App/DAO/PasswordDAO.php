<?php

namespace App\DAO;

use PDO;

class PasswordDAO extends Connection
{

    // Procura usuário pelo e-mail
    public function findUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res) {
            return $res;
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM cuidadores WHERE email = :email");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
    }

    // função para detectar a tabela
    private function detectUserTable(string $email): ?string
    {
        $tabelas = ['clientes', 'cuidadores'];

        foreach ($tabelas as $tab) {
            $stmt = $this->pdo->prepare("SELECT 1 FROM {$tab} WHERE email = :email LIMIT 1");
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            // Se achou o email nesta tabela
            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                return $tab;
            }
        }

        return null; // Não achou em nenhuma
    }



    // Salva token de recuperação
    public function saveResetToken($email, $token)
    {
        $table = $this->detectUserTable($email);

        $stmt = $this->pdo->prepare("
            UPDATE {$table}
            SET reset_token = :token,
                token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR)
            WHERE email = :email
        ");
        $stmt->bindValue(":token", $token);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
    }

    private function detectTableByToken(string $token): ?string
    {
        $tabelas = ['clientes', 'cuidadores'];

        foreach ($tabelas as $tab) {
            $stmt = $this->pdo->prepare("
            SELECT 1 FROM {$tab}
            WHERE reset_token = :token
              AND token_expiration > NOW()
            LIMIT 1
        ");
            $stmt->bindValue(':token', $token);
            $stmt->execute();

            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                return $tab;
            }
        }

        return null;
    }


    // Busca e-mail pelo token
    public function getEmailByToken($token)
    {
        $table = $this->detectTableByToken($token);

        $stmt = $this->pdo->prepare("
            SELECT email FROM {$table}
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
        $table = $this->detectUserTable($email);

        $stmt = $this->pdo->prepare("UPDATE {$table} SET senha = :senha WHERE email = :email");
        $stmt->bindValue(":senha", $newPassword);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
    }

    // Remove token após redefinição
    public function deleteToken($token)
    {
        $table = $this->detectTableByToken($token);

        $stmt = $this->pdo->prepare("
            UPDATE {$table} 
            SET reset_token = NULL, token_expiration = NULL 
            WHERE reset_token = :token
            
        ");
        $stmt->bindValue(":token", $token);
        $stmt->execute();
    }

}
