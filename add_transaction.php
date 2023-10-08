<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $amount = $_POST["amount"];

    // Verificar se os campos são vazios
    if (empty($text) || empty($amount)) {
        // Redirecionar de volta para index.php em caso de campos em branco
        header("Location: index.php");
        exit(); // Certifique-se de sair para evitar que o código seja executado adicionalmente
    } else {
        $sql = "INSERT INTO transactions (text, amount) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sd", $text, $amount);

        if ($stmt->execute()) {
            // Redirecionar de volta para index.php após a conclusão bem-sucedida
            header("Location: index.php");
            exit(); // Certifique-se de sair para evitar que o código seja executado adicionalmente
        } else {
            echo "Erro ao adicionar transação: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
}
?>
