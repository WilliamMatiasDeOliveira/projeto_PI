<?php
namespace App\Models;

class Cuidador
{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $tipo;
    private $telefone;
    private $cep;
    private $rua;
    private $bairro;
    private $cidade;
    private $senha;
    private $foto;
    private $curriculo;
    private $endereco_id;

    // Getters e Setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }

    public function getCpf() { return $this->cpf; }
    public function setCpf($cpf) { $this->cpf = $cpf; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getTipo() { return $this->tipo; }
    public function setTipo($tipo) { $this->tipo = $tipo; }

    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }

    public function getCep() { return $this->cep; }
    public function setCep($cep) { $this->cep = $cep; }

    public function getRua() { return $this->rua; }
    public function setRua($rua) { $this->rua = $rua; }

    public function getBairro() { return $this->bairro; }
    public function setBairro($bairro) { $this->bairro = $bairro; }

    public function getCidade() { return $this->cidade; }
    public function setCidade($cidade) { $this->cidade = $cidade; }

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }

    public function getFoto() { return $this->foto; }
    public function setFoto($foto) { $this->foto = $foto; }

    public function getCurriculo() { return $this->curriculo; }
    public function setCurriculo($curriculo) { $this->curriculo = $curriculo; }

    public function getEnderecoId() { return $this->endereco_id; }
    public function setEnderecoId($endereco_id) { $this->endereco_id = $endereco_id; }
}
