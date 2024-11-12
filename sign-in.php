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
    <div class="container">
        <main>
            <section class="login-form">
                <h2>Login</h2>
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="login-button">Entrar</button>

                    <div class="login-options">
                        <button type="button" class="google-login">Entrar com Google</button>
                        <a href="cadastro.php" class="register-link">Cadastrar-se</a>
                        <a href="esqueci.php" class="forgot-password">Esqueci minha senha</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Minha Loja. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
