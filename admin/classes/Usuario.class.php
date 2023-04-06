<?php
require_once('Banco.class.php');

class Usuario{
    public $id;
    public $nome;
    public $email;
    public $senha;

    // Métodos:

    // Logar:
    public function Logar(){
        $banco = Banco::conectar();
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";

        // Obter o hash da senha:
        $hashSenha = hash('sha256', $this->senha);

        $comando = $banco->prepare($sql);
        $comando->execute(array($this->email, $hashSenha));
        // "Salvar" o resultado da consulta (tabela) na $resultado
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
 
        Banco::desconectar();
 
        return $resultado;
    }

    // Cadastrar:
    public function Cadastrar(){
        $banco = Banco::conectar();
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

        // Obter o hash da senha:
        $hashSenha = hash("sha256", $this->senha);

        $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando = $banco->prepare($sql);
 
        $comando->execute(array($this->nome, $this->email, $hashSenha));
            Banco::desconectar();
            // Se der certo, devolve 1 (tratar erros posteriormente)
            return 1;
    }

}

?>