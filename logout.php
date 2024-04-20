<?php
session_start();  // Inicia a sessão

// Remove todas as variáveis da sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona o usuário para a página de login
header("Location: login.html");
exit;
?>
