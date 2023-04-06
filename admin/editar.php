<?php
session_start();

// Verificar se a sessão NÃO existe:
if (!isset($_SESSION['usuario'])) {
    // Devolver para tela de login:
    header('Location: index.php');
}

if (isset($_GET['id'])) {
    require_once('classes/Produto.class.php');
    $produto = new Produto();
    $produto->id = $_GET['id'];
    $tabela = $produto->ListarUnico();
} else {
    $tabela = [];
}



require_once('classes/Categoria.class.php');
$categoria = new Categoria();
$tabelaCat = $categoria->Listar();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Edição</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container col-4 mt-5">

        <!-- Só mostra o form de edição caso o id selecionado exista -->
        <?php if (count($tabela) == 1) { ?>

            <h1>Formulário de Edição</h1>
            <form action="actions/editar_produto.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nomeProduto">Nome</label>
                    <input type="text" class="form-control" id="nomeProduto" placeholder="Digite o nome do produto" name="nome" value="<?= $tabela[0]['nome'] ?>">
                </div>
                <div class="form-group">
                    <label for="fotoProduto">Foto</label>
                    <input type="file" class="form-control-file" id="fotoProduto" name="foto" value="<?= $tabela[0]['foto'] ?>">
                </div>
                <div class="form-group">
                    <label for="descricaoProduto">Descrição</label>
                    <textarea class="form-control" id="descricaoProduto" rows="3" name="descricao"><?= $tabela[0]['descricao'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="categoriaProduto">Categoria</label>
                    <select class="form-control" id="categoriaProduto" name="idcategoria">
                        <?php foreach ($tabelaCat as $categoria) { ?>
                            <option value="<?= $categoria['id']; ?>"><?= $categoria['nome']; ?></option>
                        <?php } ?>
                    </select> <br>
                </div>
                <div class="form-group">
                    <label for="estoqueProduto">Estoque</label>
                    <input type="number" class="form-control" id="estoqueProduto" placeholder="Digite a quantidade em estoque" name="estoque" value="<?= $tabela[0]['estoque'] ?>">
                </div>
                <div class="form-group">
                    <label for="precoProduto">Preço</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="number" class="form-control" id="precoProduto" placeholder="Digite o preço" name="preco" step="any" value="<?= $tabela[0]['preco'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                <!-- Input invisível com o id do usuário editado -->
                <input type="hidden" value="<?= $tabela[0]['id'] ?>" name="id">
            </form>
        <?php } else { ?>
            <h1>Usuário não encontrado.</h1>
            <a href="index.php" class="btn btn-primary">Voltar</a>
        <?php } ?>
    </div>

</body>

</html>