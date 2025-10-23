<?php

namespace App\Models;

class Login{
    private string $email = "";
    private string $senha = ""; 

    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }


    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getSenha(){
        return $this->senha;
    }
}