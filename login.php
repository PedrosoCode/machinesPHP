<?php
$servername = "localhost";
$username = "root";
$password = "@Inspiron1";
$dbname = "db_machines";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($senha, $user['senha'])) {
        session_start();
        $_SESSION['nome'] = $user['nome'];
        header("Location: bem_vindo.php");
        exit;
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Nenhum usuário encontrado com este e-mail!";
}

$stmt->close();
$conn->close();
?>
