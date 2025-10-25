<?php

namespace App\DAO;

use PDO;

class GetAllSpecialitysDAO extends Connection
{

    public function get_all_specialitys_dao($user_id_cuidador)
    {
        $sql = "SELECT especialidades.id_especialidade, especialidades.nome_especialidade
        FROM cuidador_especialidade
        INNER JOIN especialidades
        ON cuidador_especialidade.especialidade_id = especialidades.id_especialidade
        WHERE cuidador_especialidade.cuidador_id = :user_id_cuidador";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":user_id_cuidador", $user_id_cuidador);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;

    }
}
