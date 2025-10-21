<?php

namespace App\DAO;

use Exception;
use PDOException;

class ClienteDAO extends Connection{

    public function checkIfClientExists($email){
        $sql = "SELECT * FROM clientes WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return false;
        } else {
            return true;
        }

    }

    public function save($dados){
        try {
            // inicio da transação
            $this->pdo->beginTransaction();

            // inserir o endereco na base de dados
            $sqlEnd = "INSERT INTO enderecos(cep, cidade, bairro, rua) 
            VALUES (:cep, :cidade, :bairro, :rua)";

            $stmtEnd = $this->pdo->prepare($sqlEnd);
            $stmtEnd->bindValue(":cep", $dados['cep']);
            $stmtEnd->bindValue(":cidade", $dados['cidade']);
            $stmtEnd->bindValue(":bairro", $dados['bairro']);
            $stmtEnd->bindValue(":rua", $dados['rua']);
            $stmtEnd->execute();

            // pegar o ultimo id inserido no banco
            $endereco_id = $this->pdo->lastInsertId();

            // criptografar a senha antes de salvar no banco
            $senhaCript = password_hash($dados['senha'], PASSWORD_DEFAULT);

            // inserir o cliente com o $endereco_id
            $sqlCli = "INSERT INTO clientes(nome, email, cpf, senha, telefone, foto, endereco_id)
            VALUES(:nome, :email, :cpf, :senha, :telefone, :foto, :endereco_id)";
            
            $stmtCli = $this->pdo->prepare($sqlCli);
            $stmtCli->bindValue(":nome", $dados['nome']);
            $stmtCli->bindValue(":email", $dados['email']);
            $stmtCli->bindValue(":cpf", $dados['cpf']);
            $stmtCli->bindValue(":senha", $senhaCript);
            $stmtCli->bindValue(":telefone", $dados['telefone']);
            $stmtCli->bindValue(":foto", $dados['foto'] ?? null);
            $stmtCli->bindValue(":endereco_id", $endereco_id);
            $stmtCli->execute();

            // finaliza a transação
            $this->pdo->commit();

            return true;

        } catch (PDOException $e) {
            // desfaz a transação se algo der errado
            $this->pdo->rollBack();
            throw new Exception("Erro na transação".$e->getMessage());
        }
    }

}