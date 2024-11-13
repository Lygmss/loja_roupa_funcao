<?php
    include 'php/conexao.php';
    // Verifica se o formulário foi enviado
    function cadastrarUsuario($nome, $email, $senha, $confirmarSenha) {
        global $conn;
    
        // Verifica se as senhas coincidem
        if ($senha !== $confirmarSenha) {
            return "As senhas não coincidem!";
        }
    
        // Verifica se o e-mail já existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return "E-mail já cadastrado!";
        }
    
        // Criptografar a senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
        // Inserir o novo usuário
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
    
        if ($stmt->execute()) {
            return "Cadastro realizado com sucesso!";
        } else {
            return "Erro ao cadastrar o usuário.";
        }
    }
    
    // Capturar dados do formulário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmarSenha = $_POST['confirmar_senha'];
    
        // Exibir resultado da função de cadastro
        echo cadastrarUsuario($nome, $email, $senha, $confirmarSenha);
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
    
    <main>
        <section class="login-form">
            <h2>Login</h2>
            <form action="cadastro.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required>
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
