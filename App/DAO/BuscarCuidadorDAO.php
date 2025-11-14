<?php

namespace App\DAO;

use PDO;

class BuscarCuidadorDAO extends Connection
{

    // este metodo vai buscar todos os cuidadores que possuem a especialidade buscada
    public function buscar_por_especialidade($search)
    {

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

        /*
        
        eu sou o res do BuscarCuidadorDAOArray
(
    [0] => Array
        (
            [id_cuidador] => 2
            [nome] => sheila
            [email] => williamsheilami@gmail.com
            [telefone] => 14998546814
            [foto] => cuidador_69164eed7fde47.53046113.jpg
            [curriculo] => curriculo_69164eed803831.78885013.pdf
        )

)
        
        */

        // buscar os likes do cuidador
        for ($i = 0; $i < count($res); $i++) {
            $idCuidador = $res[$i]['id_cuidador'];
            $likes = $this->buscaLike($idCuidador);
             // Adicionar os likes no res
             $res[$i]['like'] = $likes;
        }

        // buscar os deslikes do cuidador
        for ($i = 0; $i < count($res); $i++) {
            $idCuidador = $res[$i]['id_cuidador'];
            $deslikes = $this->buscarDeslikes($idCuidador);
            // Adicionar os deslikes no res
             $res[$i]['deslike'] = $deslikes;
        }

        /*
        
Eusou o res atualizadoArray
(
    [0] => Array
        (
            [id_cuidador] => 2
            [nome] => sheila
            [email] => williamsheilami@gmail.com
            [telefone] => 14998546814
            [foto] => cuidador_69164eed7fde47.53046113.jpg
            [curriculo] => curriculo_69164eed803831.78885013.pdf
            [like] => 3
            [deslike] => 0
        )

)

        */

        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    private function buscaLike($idCuidador)
    {
        $sql = "SELECT gostei FROM avaliacoes WHERE cuidador_id = :idCuidador AND gostei <> 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":idCuidador", $idCuidador);
        $stmt->execute();
        return $stmt->rowCount();
    }

    private function buscarDeslikes($idCuidador)
    {
        $sql = "SELECT nao_gostei FROM avaliacoes WHERE cuidador_id = :idCuidador AND nao_gostei <> 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":idCuidador", $idCuidador);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
