<?php
include('../conecta_banco.php');
include('../auth_check.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepara uma instrução de inserção
    $sql = "INSERT INTO tb_cad_notebooks (Marca, Modelo, ID_usuario) VALUES (?, ?, ?)";

    if ($stmt = $conexao->prepare($sql)) {
        // Vincula variáveis como parâmetros ao prepared statement
        $stmt->bind_param("ssi", $param_marca, $param_modelo, $param_id_usuario);

        // Define parâmetros e executa
        $param_marca = $_POST['marca'];
        $param_modelo = $_POST['modelo'];
        $param_id_usuario = $_POST['id_usuario'];  // Supondo que você esteja pegando este valor de alguma forma autenticada

        if ($stmt->execute()) {
            echo "Notebook cadastrado com sucesso.";
        } else {
            echo "Erro ao cadastrar notebook: " . $stmt->error;
        }

        // Fecha o prepared statement
        $stmt->close();
    }
}

// Fecha a conexão
$conexao->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Notebook</title>
</head>
<body>
    <h1>Cadastro de Notebook</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br>
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br>
        <label for="id_usuario">ID Usuário:</label>
        <input type="text" id="id_usuario" name="id_usuario" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
