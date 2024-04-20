<?php
include('conecta_banco.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Primeiro, verificar se o e-mail já está registrado
$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // E-mail já existe, retornar erro
    echo "Erro: O e-mail fornecido já está em uso.";
} else {
    // E-mail disponível, proceder com o cadastro
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);
    if ($stmt->execute()) {
        session_start();
        $_SESSION['nome'] = $nome;
        header("Location: bem_vindo.php");
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
