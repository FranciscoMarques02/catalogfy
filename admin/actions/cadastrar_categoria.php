<?php 
require_once('../classes/Categoria.class.php');
session_start();
if(isset($_SESSION['usuario']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = strtolower($_POST['nome_categoria']);
    $nome = ucfirst($nome);

    $categoria = new Categoria();
    $categoria->nome = $nome;

    try{
        $categoria->Cadastrar();
        header("Location: ../painel.php?msg=4");
        exit;
    }catch(PDOException $e){
        header("Location: ../painel.php?err=1");
        exit;
    }
    
}else{
    echo "Você deve estar logado e/ou enviar as infos por POST.";
}
?>