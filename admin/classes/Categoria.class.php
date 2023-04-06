<?php
require_once('Banco.class.php');

class Categoria{
    public $id;
    public $nome;

    // Métodos:

    // Listar:
    public static function Listar(){
        $banco = Banco::conectar();
        $sql = "SELECT * FROM categorias ORDER BY nome";
        $comando = $banco->prepare($sql);
        $comando->execute();
        // "Salvar" o resultado da consulta (tabela) na $resultado
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
 
        Banco::desconectar();
 
        return $resultado;
    }
    // Cadastrar:
    public function Cadastrar(){
        $banco = Banco::conectar();
        $sql = "INSERT INTO categorias (nome)
        VALUES (?)";

        $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando = $banco->prepare($sql);

        $comando->execute(array($this->nome));
            Banco::desconectar();
            // Se der certo, devolve 1 (tratar erros posteriormente)
            return 1;
    }

}

?>