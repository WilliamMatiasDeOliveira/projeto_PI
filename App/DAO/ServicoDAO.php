<?php

namespace App\DAO;

use PDO;

class ServicoDAO extends Connection
{

    public function criar($id_cliente, $id_cuidador, $descricao, $valor_proposta)
    {
        // grava no banco as intenções de serviço
        $sql = "INSERT INTO servicos(data_inicio, estatus, cliente_id, cuidador_id, descricao_paciente, valor_proposta)VALUES
        (NOW(), 'pendente', :cliente_id, :cuidador_id, :descricao_paciente, :valor_proposta)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":cliente_id", $id_cliente);
        $stmt->bindValue(":cuidador_id", $id_cuidador);
        $stmt->bindValue(":descricao_paciente", $descricao);
        $stmt->bindValue(":valor_proposta", $valor_proposta);
        $stmt->execute();
    }

    // pega o email do cuidador para enviar a proposta
    public function getEmailCuidador($id_cuidador)
    {
        $sql = "SELECT email FROM cuidadores WHERE id_cuidador = :id_cuidador";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id_cuidador", $id_cuidador);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res;
    }

    public function buscarPendentesPorCuidador($idCuidador)
    {
        $sql = "SELECT * FROM servicos WHERE cuidador_id = :id AND estatus = 'pendente'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idCuidador);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}
