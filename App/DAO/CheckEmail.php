<?php

namespace App\DAO;

class CheckEmail extends Connection
{
    // função para verificar se este email já esta cadastrado no bd
    public function checkIfEmailExists($email)
    {
        // verifica na tabela clientes
        $sql = "SELECT * FROM clientes WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            return true;
        }

        // verifica na tabela cuidadores
        $sql = "SELECT * FROM cuidadores WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
