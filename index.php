<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style-alternativo.css" />
    <link rel="stylesheet" href="./excluir.css" />
    <title>Controle de despesas</title>
</head>
<body>
    <h2>Controle de despesas</h2>
    
    <div class="container">
        <h4>Saldo atual</h4>
        
        <!-- Resultados de Receitas e Despesas -->
        <h1 id="balance" class="balance">R$ 0.00</h1>
        <div class="inc-exp-container">
            <div>
                <h4>Receitas</h4>
                <p id="money-plus" class="money plus">+ R$0.00</p>
            </div>
            <div>
                <h4>Despesas</h4>
                <p id="money-minus" class="money minus">- R$0.00</p>
            </div>
        </div>

        <h3>Transações</h3>
        
        <ul id="transactions" class="transactions">
            <!-- Itens de transação serão adicionados dinamicamente aqui -->
            <?php
            // Conectar ao banco de dados e listar transações
            require_once("db.php");
            $sql = "SELECT * FROM transactions";
            $result = $conn->query($sql);

            // Inicialize as variáveis de receitas e despesas
            $totalReceitas = 0;
            $totalDespesas = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $amount = $row["amount"];

                    // Atualize as variáveis de acordo com o tipo de transação
                    if ($amount >= 0) {
                        $totalReceitas += $amount;
                    } else {
                        $totalDespesas += $amount;
                    }

                    $amountClass = $amount >= 0 ? "plus" : "minus";
                    echo "<li class='$amountClass'>" . $row["text"] . " <span>R$" . number_format($amount, 2) . "</span> <a class='delete-button' href='delete_transaction.php?id=" . $row["id"] . "'>Excluir</a></li>";
                }
            } else {
                echo "<li>Nenhuma transação encontrada.</li>";
            }
            ?>
        </ul>

        <h3>Adicionar transação</h3>
        
        <form id="form" method="post" action="add_transaction.php">
            <div class="form-control">
                <label for="text">Nome</label>
                <input autofocus type="text" id="text" name="text" placeholder="Nome da transação" />
            </div>

            <div class="form-control">
                <label for="amount">Valor <br />
                    <small>(negativo - despesas, positivo - receitas)</small>
                </label>
                <input type="number" id="amount" name="amount" placeholder="Valor da transação" />
            </div>

            <button class="btn" type="submit">Adicionar</button>
        </form>
    </div>

    <!-- JavaScript para calcular e exibir os resultados -->
    <script>
        document.getElementById('money-plus').textContent = '+ R$<?php echo number_format($totalReceitas, 2); ?>';
        document.getElementById('money-minus').textContent = '- R$<?php echo number_format(abs($totalDespesas), 2); ?>';
        document.getElementById('balance').textContent = 'R$<?php echo number_format($totalReceitas + $totalDespesas, 2); ?>';
    </script>
</body>
</html>
