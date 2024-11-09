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
                    carrinhos.qtde,
                    carrinhos.id as id_carrinho
            FROM    carrinhos
            INNER JOIN produtos ON produtos.id = carrinhos.id_produto
            WHERE id_session =:id_sessao";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_sessao',$id_sessao);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);        
}


function deletar($conn,$id_carrinho){ 
    $sql = "DELETE FROM carrinhos WHERE id=:id_carrinho";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_carrinho',$id_carrinho);
    $stmt->execute();     
}

function deletarCarrinho($conn,$id_sessao){ 
    $sql = "DELETE FROM carrinhos WHERE id_session=:id_sessao";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_sessao',$id_sessao);
    $stmt->execute();     
}

?>