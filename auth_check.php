<?php
session_start();

// Verifica se a variável de sessão 'nome' NÃO está definida ou é vazia
if (!isset($_SESSION['nome']) || empty($_SESSION['nome'])) {
    // Redireciona para a página de login
    header("Location: login.html");
    exit;
}
?>
