<?php

namespace App\DAO;

class AceitarRecusarDAO extends Connection{

    public function mudar_status($novo_status, $servico){
        $sql = "UPDATE servicos SET estatus = :estatus WHERE id_servico = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":estatus", $novo_status);
        $stmt->bindValue(":id", $servico);
        $stmt->execute();
    }
}