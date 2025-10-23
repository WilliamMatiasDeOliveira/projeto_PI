<?php

namespace App\DAO;

use App\Models\Cuidador;
use Exception;
use PDOException;

class CuidadorDAO extends Connection
{

    // metodo para salvar o cuidador no bd
    public function save(Cuidador $cuidador)
    {
        try {
            // inicio da transação
            $this->pdo->beginTransaction();

            // inserir o endereco na base de dados
            $sqlEnd = "INSERT INTO enderecos(cep, cidade, bairro, rua) 
            VALUES (:cep, :cidade, :bairro, :rua)";

            $stmtEnd = $this->pdo->prepare($sqlEnd);
            $stmtEnd->bindValue(":cep", $cuidador->getCep());
            $stmtEnd->bindValue(":cidade", $cuidador->getCidade());
            $stmtEnd->bindValue(":bairro", $cuidador->getBairro());
            $stmtEnd->bindValue(":rua", $cuidador->getRua());
            $stmtEnd->execute();

            // pegar o ultimo id inserido no banco
            $endereco_id = $this->pdo->lastInsertId();

            // criptografar a senha antes de salvar no banco
            $senhaCript = password_hash($cuidador->getSenha(), PASSWORD_DEFAULT);

            // inserir o cuidador com o $endereco_id
            $sqlCli = "INSERT INTO cuidadores(nome, email, cpf, senha, tipo, telefone, foto, curriculo, endereco_id)
            VALUES(:nome, :email, :cpf, :senha, :tipo, :telefone, :foto, :curriculo, :endereco_id)";

            $stmtCli = $this->pdo->prepare($sqlCli);
            $stmtCli->bindValue(":nome", $cuidador->getNome());
            $stmtCli->bindValue(":email", $cuidador->getEmail());
            $stmtCli->bindValue(":cpf", $cuidador->getCpf());
            $stmtCli->bindValue(":senha", $senhaCript);
            $stmtCli->bindValue(":tipo", $cuidador->getTipo());
            $stmtCli->bindValue(":telefone", $cuidador->getTelefone());
            $stmtCli->bindValue(":foto", $cuidador->getFoto());
            $stmtCli->bindValue(":curriculo", $cuidador->getCurriculo());
            $stmtCli->bindValue(":endereco_id", $endereco_id);
            $stmtCli->execute();

            // finaliza a transação
            $this->pdo->commit();

            return true;
        } catch (PDOException $e) {
            // desfaz a transação se algo der errado
            $this->pdo->rollBack();
            throw new Exception("Erro na transação" . $e->getMessage());
        }
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM cuidadores WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function saveResetToken($email, $token, $expira)
    {
        $sql = "UPDATE cuidadores SET reset_token = :token, reset_expira = :expira WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':token' => $token,
            ':expira' => $expira,
            ':email' => $email
        ]);
    }

    public function verifyToken($token)
    {
        $sql = "SELECT email FROM cuidadores WHERE reset_token = :token AND reset_expira > NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user ? $user['email'] : false;
    }

    public function updatePassword($email, $senhaHash)
    {
        $sql = "UPDATE cuidadores SET senha = :senha WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':senha' => $senhaHash,
            ':email' => $email
        ]);
    }

    public function deleteToken($token)
    {
        $sql = "UPDATE cuidadores SET reset_token = NULL, reset_expira = NULL WHERE reset_token = :token";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
    }
}
