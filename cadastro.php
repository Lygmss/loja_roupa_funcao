<?php
    include 'php/conexao.php';


    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style-login.css">
</head>
<body>
    
    <main>
        <section class="login-form">
            <h2>Login</h2>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="name" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password">Confirmação de Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="login-button">Cadastrar</button>

                <div class="login-options">
                    <button type="button" class="google-login">Entrar com Google</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Minha Loja. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
