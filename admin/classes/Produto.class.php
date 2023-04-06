<?php
require_once('Banco.class.php');

class Produto{
    public $id;
    public $nome;
    public $descricao;
    public $id_categoria;
    public $estoque;
    public $preco;
    public $id_usuario;
    public $foto;

    // Métodos:

    // listar_tudo, listar_unico, cadastrar, editar e excluir:

    // Listar tudo:
    public static function ListarTudo(){
        $banco = Banco::conectar();
        $sql = "SELECT * FROM produtos";
        $comando = $banco->prepare($sql);
        $comando->execute();
        // "Salvar" o resultado da consulta (tabela) na $resultado
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
 
        Banco::desconectar();
 
        return $resultado;
    }

    // Listar unico:
    public function ListarUnico(){
        $banco = Banco::conectar();
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $comando = $banco->prepare($sql);
        $comando->execute(array($this->id));
        // "Salvar" o resultado da consulta (tabela) na $resultado
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
 
        Banco::desconectar();
 
        return $resultado;
    }

    // Cadastrar:
    public function Cadastrar(){
        $banco = Banco::conectar();
        $sql = "INSERT INTO produtos (nome, descricao, id_categoria, estoque, preco, id_usuario, foto)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando = $banco->prepare($sql);

        $comando->execute(array($this->nome, $this->descricao, $this->id_categoria,
        $this->estoque, $this->preco, $this->id_usuario, $this->foto));
            Banco::desconectar();
            // Se der certo, devolve 1 (tratar erros posteriormente)
            return 1;
    }

    // Excluir:
    public function Apagar(){
        $banco = Banco::conectar();
        $sql = "DELETE FROM produtos WHERE id = ?";
        $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando = $banco->prepare($sql);
        // Tratamento de erro:
        try{
           $comando->execute(array($this->id));
            Banco::desconectar();
            // Retornar quantidade de linhas apagadas:
            return $comando->rowCount();
 
         }catch(PDOException $e){
            // return $e->getCode(); 
            Banco::desconectar();
            // Se der errado, devolve -1:
            return -1;
         }
    }
}


?>