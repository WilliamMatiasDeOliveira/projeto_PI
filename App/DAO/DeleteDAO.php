<?php

declare(strict_types=1);

namespace App\DAO;

use PDO;

class DeleteDAO extends Connection
{
    public function delete(int $userId, string $tabela, string $coluna): bool
    {
        // ============================
        // 1. SE FOR CLIENTE
        // ============================
        if ($tabela === "clientes") {

            // Excluir avaliações feitas pelo cliente
            $sql = "DELETE FROM avaliacoes WHERE cliente_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $userId);
            $stmt->execute();

            // Excluir serviços onde o cliente participou
            // MAS antes excluir avaliações desses serviços
            $sqlAval = "DELETE FROM avaliacoes WHERE servico_id IN 
                        (SELECT id_servico FROM servicos WHERE cliente_id = :id)";
            $stmtAval = $this->pdo->prepare($sqlAval);
            $stmtAval->bindValue(":id", $userId);
            $stmtAval->execute();

            $sqlServ = "DELETE FROM servicos WHERE cliente_id = :id";
            $stmtServ = $this->pdo->prepare($sqlServ);
            $stmtServ->bindValue(":id", $userId);
            $stmtServ->execute();
        }

        // ============================
        // 2. SE FOR CUIDADOR
        // ============================
        if ($tabela === "cuidadores") {

            // Excluir avaliações sobre o cuidador
            $sql = "DELETE FROM avaliacoes WHERE cuidador_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $userId);
            $stmt->execute();

            // Excluir avaliações de serviços realizados pelo cuidador
            $sqlAval = "DELETE FROM avaliacoes WHERE servico_id IN 
                        (SELECT id_servico FROM servicos WHERE cuidador_id = :id)";
            $stmtAval = $this->pdo->prepare($sqlAval);
            $stmtAval->bindValue(":id", $userId);
            $stmtAval->execute();

            // Excluir serviços associados ao cuidador
            $sqlServ = "DELETE FROM servicos WHERE cuidador_id = :id";
            $stmtServ = $this->pdo->prepare($sqlServ);
            $stmtServ->bindValue(":id", $userId);
            $stmtServ->execute();
        }

        // ============================
        // 3. Por fim, excluir da tabela principal
        // ============================
        $sql = "DELETE FROM $tabela WHERE $coluna = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $userId);
        $stmt->execute();

        return true;
    }
}
