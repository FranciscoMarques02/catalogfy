<?php
require_once('../classes/Banco.class.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instanciar obj:
    require_once('../classes/Produto.class.php');
    $prod = new Produto();

    // Atribuir valores dos inputs ao obj:
    $prod->nome = $_POST['nome'];
    $prod->descricao = $_POST['descricao'];
    $prod->id_categoria = $_POST['idcategoria'];
    $prod->estoque = $_POST['estoque'];
    $prod->preco = $_POST['preco'];
    $prod->id_usuario = $_SESSION['usuario']['id'];
    

    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        // Atribuir hash.extensão no nome da img:
        $novo_nome = hash_file('sha256', $_FILES['foto']['tmp_name']);
        $novo_nome = $novo_nome.".".$extensao;

        // Se usuario não mandar foto, txt "semfoto.jpg" é cadastrado:
        if(move_uploaded_file($_FILES['foto']['tmp_name'], "../../fotos/" . $novo_nome)){
            $prod->foto = $novo_nome;
        }else{
            $prod->foto = "semfoto.jpg";
        }   
    }else{
        $prod->foto = "semfoto.jpg";
    }

    try {
        $prod->Cadastrar();
        header("Location: ../painel.php?msg=1");
        exit;
    } catch (PDOException $e) {
        header("Location: ../painel.php?err=1");
        exit;
    }
}
