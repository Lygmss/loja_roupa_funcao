<?php
include "php/conexao.php";
include "funcao.php";
// setando fixo o id do produto, será recebido via $_get

$id= $_GET['id'];
$produto = listarId($conn, 'produtos', $id);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Lojas Roupas</title>
    <link rel="stylesheet" href="css/style-prod.css">
</head>
<body>
    <div class="container">
    <img src="img/originais/<?php echo $produto['imagem']?>" alt="" width="150px">
    <div class="card">
        <h2><?php echo $produto['nome']?></h2>
        <p><?php echo $produto['preco']?></p>
        <p><?php echo $produto['descricao']?></p>
        <button type="submit">Comprar</button>
        <button type="button">Voltar</button>
 
    

    </div>
</div>
</body>
</html>