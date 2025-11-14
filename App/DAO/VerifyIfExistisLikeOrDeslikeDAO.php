<?php 

namespace App\DAO;

class VerifyIfExistisLikeOrDeslikeDAO extends Connection{

    public function verifyIfExistisLikeOrDeslike($cliente_id, $cuidador_id){
        $sql = "SELECT * FROM avaliacoes WHERE cliente_id = :cliente_id AND cuidador_id = :cuidador_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":cliente_id", $cliente_id);
        $stmt->bindValue(":cuidador_id", $cuidador_id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        } else {
           return false;
        }
    }
}