<?php
include 'conectar.php';

$pdo = conectar();

$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Se a exclusão foi confirmada, exclua o registro
    if (isset($_POST['confirm'])) {
        try {
            $stmt = $pdo->prepare("DELETE FROM tb_operadores WHERE idoperador = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $message = "<div class='alert alert-success mt-4'>Operador excluído com sucesso!</div>";
            header("refresh:3;url=conoperador.php"); 
            exit;
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger mt-4'>Erro: " . $e->getMessage() . "</div>";
            header("refresh:3;url=conoperador.php"); 
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Excluir Operador</title>

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
    <h2>Excluir Operador</h2>
    <?php echo $message; ?>
    <div class="alert alert-warning">
        <p>Tem certeza que deseja excluir este operador?</p>
        <form method="post">
            <input type="hidden" name="confirm" value="1">
            <button type="submit" class="btn btn-danger">Sim, excluir</button>
            <a href="conturma.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
</body>
</html>