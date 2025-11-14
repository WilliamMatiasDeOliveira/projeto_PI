<?php 

namespace App\DAO;

use PDO;

class BuscarEstatusDAO extends Connection{

    public function buscarEstatus($id){

        // session_start();

        if($_SESSION['user']['tipo'] === "cliente"){
            $busca = "cliente_id";
        } else {
            $busca = "cuidador_id";
        }

        $res = array();
        $sql = "SELECT * FROM servicos WHERE $busca = :id AND  estatus = :estado";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":estado", "aceito");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}