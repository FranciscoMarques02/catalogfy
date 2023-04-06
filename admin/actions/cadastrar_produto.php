<?php 
require_once('../classes/Banco.class.php');
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Atribuir valores dos inputs às variaveis:
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $id_categoria = $_POST['idcategoria'];
    $estoque = $_POST['estoque'];
    $preco = $_POST['preco'];
    $id_usuario = $_SESSION['usuario']['id'];
    $foto = $_FILES['foto'];

    // Salvar foto na pasta img:
    $dir = "../img/";
    move_uploaded_file($foto['tmp_name'], "$dir/".$foto["name"]);
    

    require_once('../classes/Produto.class.php');
    $prod = new Produto();

    // Atribuir valores ao obj:
    $prod->nome = $nome;
    $prod->descricao = $descricao;
    $prod->id_categoria = $id_categoria;
    $prod->estoque = $estoque;
    $prod->preco = $preco;
    $prod->id_usuario = $id_usuario;
    $prod->foto = $foto['name'];

    try{
        $prod->Cadastrar();
        header("Location: ../painel.php?msg=1");
        exit;
    }catch(PDOException $e){
        header("Location: ../painel.php?err=1");
        exit;
    }
    
}
?>