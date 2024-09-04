<?php
include 'conectar.php'; // Inclui o arquivo com a função de conexão PDO

$pdo = conectar();

$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if (isset($_POST['btnUpdate'])) {
        $descricao = $_POST['descricao'];
        $ano = $_POST['ano'];

        if (!empty($descricao) && !empty($ano)) {
            try {
                $stmt = $pdo->prepare("UPDATE tb_turma SET descricao = :descricao, ano = :ano WHERE idturma = :id");
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':ano', $ano);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                $message = "<div class='alert alert-success mt-4'>Turma atualizada com sucesso!</div>";
                header("refresh:3;url=conturma.php"); 
                exit;
            } catch (PDOException $e) {
                $message = "<div class='alert alert-danger mt-4'>Erro: " . $e->getMessage() . "</div>";
                header("refresh:3;url=conturma.php"); 
                exit;
            }
        } else {
            $message = "<div class='alert alert-danger mt-4'>Descrição e Ano não podem ser vazios!</div>";
        }
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM tb_turma WHERE idturma = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $turma = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger mt-4'>Erro: " . $e->getMessage() . "</div>";
            header("refresh:3;url=conturma.php"); 
            exit;
        }
    }
} else {
    $message = "<div class='alert alert-danger mt-4'>ID inválido.</div>";
    header("refresh:3;url=conturma.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Alterar Turma</title>

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
    <h2>Alterar Turma</h2>
    <?php echo $message; ?>
    <?php if (isset($turma)): ?>
        <form method="post">
            <div class="form-group">
                <label>Descrição:</label>
                <input type="text" class="form-control" name="descricao" value="<?php echo htmlspecialchars($turma['descricao']); ?>" required>
            </div>
            <div class="form-group">
                <label>Ano:</label>
                <input type="number" class="form-control" name="ano" value="<?php echo htmlspecialchars($turma['ano']); ?>" required>
            </div>
            <button type="submit" name="btnUpdate" class="btn btn-primary">Alterar</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>