<?php

namespace App\Models;

class Login
{
    private string $email = "";
    private string $senha = "";

    // GETTERS
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    // SETTERS
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }
}
