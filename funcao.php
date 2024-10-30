<?php
// função generica que lista todos os dados de uma tabela
function listar($conn,$tabela){ 
    $sql = "SELECT * FROM $tabela";   
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);        
}

// funcao generica que lista os dados por id
// funcao recebe o parametro do conexao, a tabela e o id para o SELECT
function listarId($conn,$tabela, $id){ 
    $sql = "SELECT * FROM $tabela WHERE id=:id";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);        
}

// funçaõ generica que deleta itens por id de uma tabela
function deletar($conn,$tabela,$id){ 
    $sql = "DELETE FROM $tabela WHERE id=:id";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();     
}
?>