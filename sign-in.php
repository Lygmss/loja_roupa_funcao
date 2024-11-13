<?php
    include 'php/conexao.php';

    // Verifica se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se os campos estão preenchidos
    if (empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Consulta o banco de dados para verificar o e-mail
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Salva os dados do usuário na sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        
        // Redireciona para a área do usuário
        header("Location: cadastroRealiz.php");
        exit;
    } else {
        echo "E-mail ou senha incorretos.";
    }
}

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
                <form action="sign-in.php" method="POST">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="senha" required>
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
