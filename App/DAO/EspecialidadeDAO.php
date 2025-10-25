<?php

namespace App\DAO;

use PDO;

class EspecialidadeDAO extends Connection
{
    /**
     * @param string
     * 
     * return id da especialidade
     * @return int
     */

    public function checkIfThisSpecialtyExists($especialidade)
    {
        $sql = "SELECT * FROM especialidades WHERE nome_especialidade = :especialidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":especialidade", $especialidade);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res) {
            return $res['id_especialidade'];
        } else {
            return false;
        }
    }
}
