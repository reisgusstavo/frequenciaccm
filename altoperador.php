<?php
include 'conectar.php'; // Inclui o arquivo com a função de conexão PDO

$pdo = conectar();
$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if (isset($_POST['btnUpdate'])) {
        $nomeoperador = $_POST['nomeoperador'];
        $senha = !empty($_POST['senha']) ? md5($_POST['senha']) : null; // Criptografa a senha usando MD5

        if (!empty($nomeoperador)) {
            try {
                $sql = "UPDATE tb_operadores SET nomeoperador = :nomeoperador";
                if ($senha) {
                    $sql .= ", senha = :senha";
                }
                $sql .= " WHERE idoperador = :id";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nomeoperador', $nomeoperador);
                if ($senha) {
                    $stmt->bindParam(':senha', $senha);
                }
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                $message = "<div class='alert alert-success mt-4'>Operador atualizado com sucesso!</div>";
                header("refresh:3;url=conoperador.php"); // Redireciona após 3 segundos
                exit;
            } catch (PDOException $e) {
                $message = "<div class='alert alert-danger mt-4'>Erro: " . $e->getMessage() . "</div>";
                header("refresh:3;url=conoperador.php"); // Redireciona após 3 segundos
                exit;
            }
        } else {
            $message = "<div class='alert alert-danger mt-4'>Preencha todos os campos.</div>";
        }
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM tb_operadores WHERE idoperador = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $operador = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger mt-4'>Erro: " . $e->getMessage() . "</div>";
            header("refresh:3;url=conoperador.php"); // Redireciona após 3 segundos
            exit;
        }
    }
} else {
    $message = "<div class='alert alert-danger mt-4'>ID inválido.</div>";
    header("refresh:3;url=conoperador.php"); // Redireciona após 3 segundos
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Alterar Operador</title>

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
    <h2>Alterar Operador</h2>
    <?php echo $message; ?>
    <?php if (isset($operador)): ?>
        <form method="post">
            <div class="form-group">
                <label>Nome do Operador:</label>
                <input type="text" class="form-control" name="nomeoperador" value="<?php echo htmlspecialchars($operador['nomeoperador']); ?>" required>
            </div>
            <div class="form-group">
                <label>Nova Senha (deixe em branco para não alterar):</label>
                <input type="password" class="form-control" name="senha">
            </div>
            <button type="submit" name="btnUpdate" class="btn btn-primary">Alterar</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>