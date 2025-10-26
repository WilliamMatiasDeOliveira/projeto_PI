<?php

namespace App\DAO;

use PDO;

class BuscarCuidadorDAO extends Connection
{

    // este metodo vai buscar todos os cuidadores que possuem a especialidade buscada
    public function buscar_por_especialidade($search) {

        $sql = "
            SELECT c.id_cuidador, c.nome, c.email, c.telefone, c.foto, c.curriculo
            FROM cuidadores c
            INNER JOIN cuidador_especialidade ce ON c.id_cuidador = ce.cuidador_id
            INNER JOIN especialidades e ON e.id_especialidade = ce.especialidade_id
            WHERE e.nome_especialidade = :search
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":search", $search);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($res){
            return $res;
        } else {
            return false;
        }

        
    }



}
