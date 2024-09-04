<?php
include 'conectar.php'; // Inclui o arquivo com a função de conexão PDO

$pdo = conectar();
$message = '';

if (isset($_POST['btnAdd'])) {
    $nomeoperador = $_POST['nomeoperador'];
    $senha = md5($_POST['senha']); // Criptografa a senha usando MD5

    if (!empty($nomeoperador) && !empty($senha)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_operadores (nomeoperador, senha) VALUES (:nomeoperador, :senha)");
            $stmt->bindParam(':nomeoperador', $nomeoperador);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
            $message = "<div class='alert alert-success mt-4'>Operador adicionado com sucesso!</div>";
            header("refresh:3;url=incoperador.php"); // Redireciona após 3 segundos
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
    <meta charset="UTF-8">
    <title>Formulário de Inclusão de Grupo</title>
    <link rel ="stylesheet" href="css/operador.css">

</head>
<body>
    
<div class="container">
    <div class= "form-image"> 
         <img src="img/imgoperador.svg"> 
    </div>
<div class="form">
   <form method="post">
     <div class="form-group">
        <div class="title">
            <h1>Cadastro de Operador</h1>
        </div>

        <div class="input-group">


    <div class="input-box">
            <label>Nome Operador:</label>
            <input type="text" name="nomeoperador" placeholder="Insira o nome do Operador" >
    </div>
    <div class="input-box">
            <label>Senha:</label>
            <input type="text" name="senha" placeholder="Insira sua senha" >
    </div>
    </div>

    <div class="login-button">
        <button type="submit" name="btnAdd" class="btn btn-primary">Adicionar</button>
    </div>
</div>
</form>
    </div>
</div>
</body>
</html>