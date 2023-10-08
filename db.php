<?php
$host = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL (no seu caso, "root")
$password = "pass"; // Senha do MySQL (no seu caso, "pass")
$database = "controle_despesas"; // Nome do banco de dados que você criou ("controle_despesas")

// Conectar ao banco de dados MySQL
$conn = new mysqli($host, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
