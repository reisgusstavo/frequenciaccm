
<?php
include 'conectar.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conectar();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Lista de Turmas</title>

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
    <h2>Listagem de Turmas</h2>
    <a href="incturma.php" class="btn btn-success mb-3">Adicionar Nova Turma</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
    <?php
    try {
        $sql = "SELECT * FROM tb_turma";
        $stmt = $pdo->query($sql);
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['idturma']) . "</td>";
            echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ano']) . "</td>";echo "<td>";
            echo "<a href='altturma.php?id=" . htmlspecialchars($row['idturma']) . "' class='btn btn-warning btn-sm'>Alterar</a> ";
            echo "<a href='excturma.php?id=" . htmlspecialchars($row['idturma']) . "' class='btn btn-danger btn-sm'>Excluir</a>";
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
