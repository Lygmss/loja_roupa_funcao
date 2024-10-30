<?php
include "php/conexao.php";
include "funcao.php";
$categoria = listar($conn,'produtos');

deletar($conn,'categoria',1);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Lojas Roupas</title>
    <link rel="stylesheet" href="css/style-cat.css">
</head>
<body>
    <div class="container">

        <div class="lista">
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Produto</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Camiseta</td>
                <td>Roupas</td>
                <td>R$ 50,00</td>
                <td>
                    <button class="action-button delete-button">Deletar</button>
                </td>
            </tr>
            <!-- Adicione mais linhas conforme necessário -->
        </tbody>
    </table>
        </div>
    </div>
</body>
</html>