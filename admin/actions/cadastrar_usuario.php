<?php

// Verificar se a pág está sendo carregada por POST:
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Importar a classe Usuario:
    require_once('../classes/Usuario.class.php');

    // Instanciar o obj:
    $usr = new Usuario();

    // Armazenar os valores dos inputs nos atributos do obj:
    $usr->nome = $nome;
    $usr->email = $email;
    $usr->senha = $senha;

    // Verificar se o email já foi cadastrado:
    try{
        $usr->Cadastrar();
        // Redirecionar à tela de login:
        header('Location: ../index.php?msg=0');
        exit;
    }catch(PDOException $e){
        header('Location: ../index.php?err=2');
        exit;
    }
    
}


?>