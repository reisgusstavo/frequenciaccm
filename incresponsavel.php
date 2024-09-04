<?php
include 'conectar.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Inclusão de Responsaveis</title>
    <link rel ="stylesheet" href="css/responsavel.css">

</head>
<body>
    
<div class="container">
    <div class= "form-image"> 
         <img src="img/imgresponsaveis.svg"> 
    </div>
<div class="form">
   <form method="post">
     <div class="form-group">
        <div class="title">
            <h1>Cadastro de Responsaveis</h1>
        </div>

        <div class="input-group">


    <div class="input-box">
            <label>Responsável 1:</label>
            <input type="text" class="form-control" name="nome1" placeholder="Insira o nome do responsavel 1" required>
    </div>
    <div class="input-box">
            <label>Responsável 2:</label>
            <input type="text" class="form-control" name="nome2" placeholder="Insira o nome do responsavel 2" required>
    </div>

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

<?php
if (isset($_POST['btnAdd'])) {

    $nome1 = $_POST['nome1'];
    $nome2 = $_POST['nome2'];


    if (!empty($nome1) && !empty($nome2)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_responsavel(nome1, nome2) VALUES (:nome1, :nome2)");
            $stmt->bindParam(':nome1', $nome1);
            $stmt->bindParam(':nome2', $nome2);
            $stmt->execute();
            echo "Responsaveis cadastrado com sucesso!";
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Os campos não pode estar vazios!";
    }
}
?>