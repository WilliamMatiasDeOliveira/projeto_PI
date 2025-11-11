<?php

namespace App\DAO;

use Exception;
use PDO;
use PDOException;

class AtualizarDAO extends Connection
{
    public function atualizar($tabela, $id)
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        if (isset($_SESSION['endereco'])) {
            $endereco = $_SESSION['endereco'];
        }

        try {
            $this->pdo->beginTransaction();

            if ($user['tipo'] === 'cliente') {
                //  Atualiza dados do usuário se for cliente
                $sqlUser = "UPDATE $tabela SET
                nome = :nome,
                cpf = :cpf,
                email = :email,
                telefone = :telefone,
                foto = :foto
                WHERE " . ($tabela === 'clientes' ? 'id_cliente' : 'id_cuidador') . " = :id";

                $stmt = $this->pdo->prepare($sqlUser);
                $stmt->bindValue(":nome", $user['nome']);
                $stmt->bindValue(":cpf", $user['cpf']);
                $stmt->bindValue(":email", $user['email']);
                $stmt->bindValue(":telefone", $user['telefone']);
                $stmt->bindValue(":foto", $user['foto']);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
            } else {
                //  Atualiza dados do usuário se for cuidador
                $sqlUser = "UPDATE $tabela SET
                nome = :nome,
                cpf = :cpf,
                email = :email,
                telefone = :telefone,
                foto = :foto,
                curriculo = :curriculo
                WHERE " . ($tabela === 'clientes' ? 'id_cliente' : 'id_cuidador') . " = :id";

                $stmt = $this->pdo->prepare($sqlUser);
                $stmt->bindValue(":nome", $user['nome']);
                $stmt->bindValue(":cpf", $user['cpf']);
                $stmt->bindValue(":email", $user['email']);
                $stmt->bindValue(":telefone", $user['telefone']);
                $stmt->bindValue(":foto", $user['foto']);
                $stmt->bindValue(":curriculo", $user['curriculo']);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
            }



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
            $stmt->bindValue(":cep", $endereco['cep']);
            $stmt->bindValue(":cidade", $endereco['cidade']);
            $stmt->bindValue(":bairro", $endereco['bairro']);
            $stmt->bindValue(":rua", $endereco['rua']);
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
