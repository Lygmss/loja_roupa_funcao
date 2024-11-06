<?php
include "php/conexao.php";
// começa a sessao
session_start();
// captura o id da sessão
$id_sessao = session_id();

// caso um produto esteja sendo add no carrinho, será enviado via get o id, aí a funcao addcarrinho é executada
// verifica se a pagina esta recebendo o id via get
if(isset($_GET['id'])){
    // captura o id do produto recebido via get
    $id_produto = $_GET['id'];
    addCarrinho($conn,$id_sessao,$id_produto,1);
}
if(isset($_POST['deletar'])){
    $id_produto = $_POST['deletar'];
    deletar($conn,$id_sessao,$id_produto);
}
$produtos= listarCarrinho($conn,$id_sessao);

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


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Lojas Roupas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Loja de Roupas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            </ul>
            <form class="d-flex mt-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
            </form>
        </div>
        </div>
    </div>
    </nav>
    <div class="container text-center pt-5 mt-5">

    <section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">
<!-- !!!! -->
              <div class="col-lg-7">
                <h5 class="mb-3"><a href="produto.php?id=<?php echo $produto['id']?>" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continuar comprando</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Carrinho de compras</p>
                    <p class="mb-0">Você possui 4 itens no seu carrinho</p>
                  </div>
                  <div>
                    <p class="mb-0"><span class="text-muted">Ordenar:</span> <a href="#!"
                        class="text-body">Preço <i class="fas fa-angle-down mt-1"></i></a></p>
                  </div>
                </div>

                <?php
                foreach($produtos as $produto){
                ?>
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img
                            src="img/<?php echo $produto['imagem']?>" alt="Imagem do produto"
                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>
                        <div class="ms-3">
                          <h5><?php echo $produto['nome']?></h5>
                          <p class="small mb-0"><?php echo $produto['descricao']?></p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                          <h5 class="fw-normal mb-0"><?php echo $produto['qtde']?></h5>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0"><?php echo $produto['preco']?></h5>
                        </div>
                        <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                        <form action="carrinho.php" method="post">
                        <button type="submit" class="delete" name="deletar" value="<?php echo $produto['id']?>">Deletar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                }
                ?>

              </div>
              <div class="col-lg-5">

                <div class="card bg-dark text-white rounded-3">
                  <div class="card-body">
                    Finalizar Compra
                    

                    <form class="mt-4">
                      

                    </form>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2">$4798.00</p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Frete</p>
                      <p class="mb-2">$20.00</p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total</p>
                      <p class="mb-2">$4818.00</p>
                    </div>

                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                        <span>Finalizar <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button>

                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
       
    </div>
    
        
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</body>
</html>