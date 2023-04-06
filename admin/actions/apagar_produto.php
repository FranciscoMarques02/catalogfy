<?php
session_start();

if(isset($_GET['id']) && isset($_SESSION['usuario'])){
    require_once('../classes/Produto.class.php');

    $prod = new Produto();
    $prod->id = $_GET['id'];

    $qtd_linhas_apagadas = $prod->Apagar();

    if($qtd_linhas_apagadas >= 1){
        header('Location: ../painel.php?msg=3');
    }else{
        header('Location: ../painel.php?err=3');
    }
}
?>