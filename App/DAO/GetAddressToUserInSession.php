<?php

namespace App\DAO;

use PDO;

class GetAddressToUserInSession extends Connection{

    public function getEnderecoToUserInSession($user){
        if($user['tipo'] === "cliente"){
            $sql = "SELECT * FROM enderecos WHERE  id_endereco = :endereco_id";
            $id = $user['endereco_id'];
        } else {
            $sql = "SELECT * FROM enderecos WHERE id_endereco = :endereco_id ";
            $id = $user['endereco_id'];
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":endereco_id", $id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
}