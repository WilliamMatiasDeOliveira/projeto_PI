<?php

namespace App\DAO;

use PDO;

class VerPropostaDAO extends Connection{

    public function buscar_propostas($id_cuidador){
        $sql = "SELECT * FROM servicos WHERE cuidador_id = :id_cuidador AND estatus = 'pendente'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id_cuidador", $id_cuidador);
        $stmt->execute();

        $propostas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $propostas;


    }
}