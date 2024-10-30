<?php
include "php/conexao.php";

$produtos = listar($conn,'produtos');
$categorias = listar($conn,'categoria');

// deletar($conn,'categoria',1);

function listar($conn,$tabela){ 
    $sql = "SELECT * FROM $tabela";   
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);        
}

function deletar($conn,$tabela,$id){ 
    $sql = "DELETE FROM $tabela WHERE id=:id";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();     
}


?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Lojas Roupas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
    <h1>Listagem de produtos</h1>
    <div class="grid">
    <?php
     foreach($produtos as $produto){
    ?>
    <div class="card">
        <img src="img/<?php echo $produto['imagem']?>" alt="Imagem do produto">
        <h2><?php echo $produto['nome']?></h2>
        <h4><?php echo $produto['categoria']?></h4>
        <h3><?php echo $produto['preco']?></h3>
    </div>   
    <?php
     }
    ?>
    </div>
</div>
</body>
</html>