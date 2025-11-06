<?php

namespace App\DAO;

class AtualizarFotoDAO extends Connection
{
    public function atualizar($tipo, $caminhoDB, $id)
    {
        if ($tipo === 'cuidador') {
            $tabela = 'cuidadores';
            $campoId = 'id_cuidador';
        } elseif ($tipo === 'cliente') {
            $tabela = 'clientes';
            $campoId = 'id_cliente';
        } else {
            return false; // tipo inválido
        }

        // Prepara a query
        $sql = "UPDATE {$tabela} SET foto = :foto WHERE {$campoId} = :id";
        $stmt = $this->pdo->prepare($sql);

        // Executa a query
        return $stmt->execute([
            ':foto' => $caminhoDB,
            ':id'   => $id
        ]);
    }
}
