<?php
session_start();
if(isset($_SESSION['usuario']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once('../classes/Produto.class.php');
    $p = new Produto();
    $p->id = $_POST['id'];
    $p->nome = $_POST['nome'];
    $p->descricao = $_POST['descricao'];
    $p->id_categoria = $_POST['idcategoria'];
    $p->estoque = $_POST['estoque'];
    $p->preco = $_POST['preco'];
    $p->id_usuario = $_SESSION['usuario']['id'];
    

    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        // Atribuir hash.extensão no nome da img:
        $novo_nome = hash_file('sha256', $_FILES['foto']['tmp_name']);
        $novo_nome = $novo_nome.".".$extensao;

        // Se usuario não mandar foto, txt "semfoto.jpg" é cadastrado:
        if(move_uploaded_file($_FILES['foto']['tmp_name'], "../../fotos/" . $novo_nome)){
            $p->foto = $novo_nome;
        }else{
            $p->foto = "semfoto.jpg";
        }   
    }else{
        $p->foto = $_POST['foto_antiga'];
    }

    $qtd_linhas = $p->Editar();
    
    if($qtd_linhas == 1){
        header("Location: ../painel.php?msg=2");
        exit;
    }else{
        header("Location: ../painel.php?err=4");
        exit;
    }
        
   
        
     
}




?>