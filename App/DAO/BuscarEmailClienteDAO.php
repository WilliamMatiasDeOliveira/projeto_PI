<?php

namespace App\DAO;

use PDO;

class BuscarEmailClienteDAO extends Connection{
    public function buscarEmailCliente($cliente_id){
        $sql = "SELECT email FROM clientes WHERE id_cliente = :cliente_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":cliente_id", $cliente_id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res;
    }
}