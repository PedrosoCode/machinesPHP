<?php
$servername = "localhost";
$username = "root";
$password = "@Inspiron1";
$dbname = "db_machines";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha);

if ($stmt->execute()) {
    session_start();
    $_SESSION['nome'] = $nome;
    header("Location: bem_vindo.php");
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
