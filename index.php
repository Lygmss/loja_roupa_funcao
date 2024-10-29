<?php
include "php/conexao.php";

$produtos = listar($conn,'produtos');
$categorias = listar($conn,'categorias');
$usuarios = listar($conn,'usuarios');

deletar($conn,'categorias',1);

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
    <h1>Listagem de produtos</h1>

    <div class="card">
        <img src="img/produto_001.jpg" alt="Imagem do produto">
        <h2>Camiseta Básica</h2>
        <h4>Camisetas</h4>
        <h3>R$ 29.90</h3>
    </div>   
    
</body>
</html>