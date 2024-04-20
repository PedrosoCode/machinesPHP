<?php
$servername = "localhost";
$username = "root";
$password = "@Inspiron1";
$dbname = "db_machines";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo("Banco linkado")
//TODO - Criar e usar variáveis de ambiente
?>
