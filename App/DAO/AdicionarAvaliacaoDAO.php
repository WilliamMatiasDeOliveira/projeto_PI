<?php 

namespace App\DAO;

use PDO;

class AdicionarAvaliacaoDAO extends Connection{

    public function AdicionarAvaliacao($id){

        if($_SESSION['user']['tipo'] === "cliente"){
            $tabela = "cuidadores";
            $idUser = "id_cuidador";
        } else {
            $tabela = "cuidadores";
            $idUser = "id_cuidador";
        }

        $sql = "SELECT * FROM $tabela WHERE $idUser = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function setarAvaliacao($like, $deslike, $cliente_id, $cuidador_id, $id_servico){
        $sql = "INSERT INTO avaliacoes (gostei, nao_gostei, cliente_id, cuidador_id, servico_id) VALUES
        (:gostei, :nao_gostei, :cliente_id, :cuidador_id, :servico_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":gostei", $like);
        $stmt->bindValue(":nao_gostei", $deslike);
        $stmt->bindValue(":cliente_id", $cliente_id);
        $stmt->bindValue(":cuidador_id", $cuidador_id);
        $stmt->bindValue(":servico_id", $id_servico);
        $stmt->execute();

        
    }
}