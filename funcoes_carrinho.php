<?php
function addCarrinho($conn,$id_sessao,$id_produto,$quantidade){
    $sql= "INSERT INTO carrinhos (id_session,id_produto,qtde) VALUES (:id_sessao,:id_produto,:quantidade)";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':id_sessao',$id_sessao);
    $stmt->bindParam(':id_produto',$id_produto);
    $stmt->bindParam(':quantidade',$quantidade);
    $stmt->execute();
}


function listarCarrinho($conn,$id_sessao){ 
    $sql = "SELECT produtos.*,
                    carrinhos.qtde
            FROM    carrinhos
            INNER JOIN produtos ON produtos.id = carrinhos.id_produto
            WHERE id_session =:id_sessao";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_sessao',$id_sessao);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);        
}


function deletar($conn,$id_sessao,$id_produto){ 
    $sql = "DELETE FROM carrinhos WHERE id_session=:id_sessao AND id_produto=:id_produto";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_sessao',$id_sessao);
    $stmt->bindParam(':id_produto',$id_produto);
    $stmt->execute();     
}
?>