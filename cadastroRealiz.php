<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit;
}

// Exibe a área do usuário
echo "<h1>Bem-vindo, " . htmlspecialchars($_SESSION['usuario_nome']) . "!</h1>";
echo "<p>Você está na área do usuário.</p>";
?>
