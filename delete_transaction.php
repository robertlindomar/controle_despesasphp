<?php
// delete_transaction.php
require_once("db.php");

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Executar uma consulta SQL para excluir a transação com base no ID
    $sql = "DELETE FROM transactions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirecionar de volta para a página inicial (index) após a exclusão bem-sucedida
        header("Location: index.php");
        exit(); // Certifique-se de sair para evitar que o código seja executado adicionalmente
    } else {
        echo "Erro ao excluir a transação: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de transação inválido.";
}
?>
