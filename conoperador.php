<?php
include 'conectar.php'; // Inclui o arquivo com a função de conexão PDO

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Operadores</title>

    <!-- online -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- offline -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Lista de Operadores</h2>
    <a href="incoperador.php" class="btn btn-success mb-3">Adicionar Novo Operador</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Operador</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
    <?php
    try {
        $sql = "SELECT * FROM tb_operadores";
        $stmt = $pdo->query($sql);
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['idoperador']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nomeoperador']) . "</td>";
            echo "<td>";
            echo "<a href='altoperador.php?id=" . htmlspecialchars($row['idoperador']) . "' class='btn btn-warning btn-sm'>Alterar</a> ";
            echo "<a href='excoperador.php?id=" . htmlspecialchars($row['idoperador']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este operador?\")'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger mt-4'>Erro: " . $e->getMessage() . "</div>";
    }
    ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>