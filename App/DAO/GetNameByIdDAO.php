<?php

namespace App\DAO;

use App\DAO\Connection;
use PDO;

class GetNameByIdDAO extends Connection{

    public function getNameById($id_cliente){
        $sql = "SELECT nome FROM clientes WHERE id_cliente = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id_cliente);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res;

        

    }
}