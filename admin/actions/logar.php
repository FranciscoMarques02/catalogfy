<?php
// Verificar se está sendo carregada por POST:
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Receber valores dos inputs:
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Importar classe:
    require_once('../classes/Usuario.class.php');
    $usuario = new Usuario();
    $usuario->email = $email;
    $usuario->senha = $senha;

    // Salvar qtd de linhas:
    $resultado = $usuario->Logar();

    // Criar sessão caso retorne 1:
    if(count($resultado) == 1){
        session_start();
        $_SESSION['usuario'] = $resultado[0];
        header('Location: ../painel.php');
    }else{
        header('Location: ../index.php?err=0');
    }

}
?>