<?php

namespace App\DAO;

use PDO;

class AddSpeciality extends Connection{

    public function add_speciality($cuidador_id, $especialidade_id){

        // Este trecho tenta buscar a combinação de cuidador_id e especialidade_id 
        // na tabela cuidador_especialidade
        $sql = "SELECT * FROM cuidador_especialidade WHERE cuidador_id = :c AND especialidade_id = :e";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":c", $cuidador_id);
        $stmt->bindValue(":e", $especialidade_id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        // Caso encontre a combinação significa que este cuidador ja cadastrou esta especialidade e retorna false
        if($res){
            return false;
        } else {
            // Se não achou a combinação cadastra uma nova especialidade
            // na tabela cuidador_especialidade vinculando o cuidador_id ao especialidade_id
            $sql = "INSERT INTO cuidador_especialidade (cuidador_id, especialidade_id) 
            VALUES($cuidador_id, $especialidade_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        }

    }
}