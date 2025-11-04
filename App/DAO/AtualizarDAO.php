<?php

namespace App\DAO;

use Exception;
use PDO;
use PDOException;

class AtualizarDAO extends Connection
{
    public function atualizar($tabela, $id, $dados)
    {

        try {
            $this->pdo->beginTransaction();

            //  Atualiza dados do usuário
            $sqlUser = "UPDATE $tabela SET
            nome = :nome,
            cpf = :cpf,
            email = :email,
            telefone = :telefone
            WHERE " . ($tabela === 'clientes' ? 'id_cliente' : 'id_cuidador') . " = :id";

            $stmt = $this->pdo->prepare($sqlUser);
            $stmt->bindValue(":nome", $dados['nome']);
            $stmt->bindValue(":cpf", $dados['cpf']);
            $stmt->bindValue(":email", $dados['email']);
            $stmt->bindValue(":telefone", $dados['telefone']);
            $stmt->bindValue(":id", $id);
            $stmt->execute();

            // Busca o endereco_id vinculado a este usuário
            $sqlBuscaEndereco = "SELECT endereco_id FROM $tabela WHERE " .
                ($tabela === 'clientes' ? 'id_cliente' : 'id_cuidador') . " = :id";
            $stmt = $this->pdo->prepare($sqlBuscaEndereco);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row || !$row['endereco_id']) {
                throw new Exception("Endereço não encontrado para este usuário.");
            }

            $endereco_id = $row['endereco_id'];

            // Atualiza a tabela de endereços
            $sqlEndereco = "UPDATE enderecos SET 
            cep = :cep,
            cidade = :cidade,
            bairro = :bairro,
            rua = :rua
            WHERE id_endereco = :endereco_id";

            $stmt = $this->pdo->prepare($sqlEndereco);
            $stmt->bindValue(":cep", $dados['cep']);
            $stmt->bindValue(":cidade", $dados['cidade']);
            $stmt->bindValue(":bairro", $dados['bairro']);
            $stmt->bindValue(":rua", $dados['rua']);
            $stmt->bindValue(":endereco_id", $endereco_id);
            $stmt->execute();

            // Confirma a transação
            $this->pdo->commit();
            return true;
            
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw new Exception("Erro ao atualizar os dados: " . $e->getMessage());
            return false;
        }
    }
}
