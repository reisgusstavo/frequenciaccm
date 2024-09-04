<?php
include 'conectar.php'; // Inclui o arquivo com a função de conexão PDO

session_start();

$pdo = conectar();
$message = '';

if (isset($_POST['btnLogin'])) {
    $nomeoperador = $_POST['nomeoperador'];
    $senha = md5($_POST['senha']); // Criptografa a senha usando MD5

    if (!empty($nomeoperador) && !empty($senha)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM tb_operadores WHERE nomeoperador = :nomeoperador AND senha = :senha");
            $stmt->bindParam(':nomeoperador', $nomeoperador);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
            $operador = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($operador) {
                $_SESSION['nomeoperador'] = $operador['nomeoperador'];
                header("Location: menu.html"); // Redireciona para a página de consulta após login bem-sucedido
                exit;
            } else {
                $message = "<div class='alert alert-danger mt-4'>Nome do operador ou senha incorretos.</div>";
            }
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger mt-4'>Erro: " . $e->getMessage() . "</div>";
        }
    } else {
        $message = "<div class='alert alert-danger mt-4'>Preencha todos os campos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="main-login">
    <div class="left-login">
        <h1>Faça login<br>E entre no nosso sistema</h1>
        <img src="img/logo.svg" class="left-login-image" alt="imagem">
    </div>
    <div class="right-login">
        <div class="card-login">
            <h1>LOGIN</h1>
        <form method="post">
            <div class="textfild">
                <label>Operador:</label>
                <input type="text" class="form-control col-6" name="nomeoperador" placeholder="Entre com o Usuario" required>
            </div>
            <div class="textfild">
                <label>Senha:</label>
                <input type="password" class="form-control col-6" name="senha" placeholder="Entre com a senha" required>
            </div>
            <button type="submit" name="btnLogin" class="btnLogin">Login</button>
        </form> 
            <?php echo $message; ?>
        </div>
    </div>
</body>
</html>