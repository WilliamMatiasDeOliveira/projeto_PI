<?php

namespace App\DAO;

use App\Models\Login;
use PDO;

class LoginDAO extends Connection
{
public function login_submit_dao(Login $login)
{
    // ==============================
    // CLIENTES
    // ==============================
    $sql = "SELECT * FROM clientes WHERE email = :email";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":email", $login->getEmail());
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($login->getSenha(), $cliente['senha'])) {
            session_start();
            $_SESSION['user'] = $cliente;
            return true;
        } else {
            // email existe, mas senha errada
            return false;
        }
    }

    // ==============================
    // CUIDADORES
    // ==============================
    $sql = "SELECT * FROM cuidadores WHERE email = :email";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":email", $login->getEmail());
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $cuidador = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($login->getSenha(), $cuidador['senha'])) {
            session_start();
            $_SESSION['user'] = $cuidador;
            return true;
        } else {
            // email existe, mas senha errada
            return false;
        }
    }

    // Se não for encontrado nem em clientes nem cuidadores
    return false;
}














    // public function login_submit_dao(Login $login)
    // {
    //     $sql = "SELECT * FROM clientes WHERE email = :email";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindValue(":email", $login->getEmail());
    //     $stmt->execute();

    //     // verifica se existe este email cadastrado na tabela clientes
    //     if ($stmt->rowCount() === 0) {
    //         return false;
    //     }

    //     // se existir o email cadastrado pega todos os dados do cliente e transforma em um array associativo
    //     $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    //     // se a senha que o CLIENTE digitou bater com a que esta na tabela clientes

    //     if (password_verify($login->getSenha(), $cliente['senha'])) {
    //         session_start();
    //         $_SESSION['user'] = $cliente;
    //         return true;
    //     } else {
    //         return false;
    //     }

    //     // //////////////////////////////
    //     // CASO O USUARIO SEJA CUIDADOR
    //     // //////////////////////////////
    //     $sql = "SELECT * FROM cuidadores WHERE email = :email";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindValue(":email", $login->getEmail());
    //     $stmt->execute();

    //     // verifica se existe este email cadastrado na tabela cuidadores
    //     if ($stmt->rowCount() === 0) {
    //         return false;
    //     }

    //     // se existir o email cadastrado pega todos os dados do cliente e transforma em um array associativo
    //     $cuidador = $stmt->fetch(PDO::FETCH_ASSOC);
    //     // se a senha que o CUIDADOR digitou bater com a que esta na tabela clientes
    //     if (password_verify($login->getSenha(), $cuidador['senha'])) {
    //         session_start();
    //         $_SESSION['user'] = $cuidador;
    //         return true;
    //     } else {
    //         return false;
    //     }

    //     echo "Cheguei no fim";

    //     // return false;
    // }
}
