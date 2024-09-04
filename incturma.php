<?php
include 'conectar.php'; // Inclui o arquivo com a função de conexão PDO

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Inclusão de Turma</title>
    <link rel ="stylesheet" href="css/aluno.css">

</head>
<body>
    
<div class="container">
    <div class= "form-image"> 
         <img src="img/imgturma.svg"> 
    </div>
<div class="form">
   <form method="post">
     <div class="form-group">
        <div class="title">
            <h1>Cadastro de Turma</h1>
        </div>

        <div class="input-group">


    <div class="input-box">
            <label>Descrição:</label>
            <input type="text" name="descricao" placeholder="Insira a descrição da turma" >
    </div>
    <div class="input-box">
            <label>Ano:</label>
            <input type="text" name="ano" placeholder="ANO" >
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
        $descricao = $_POST['descricao'];
        $ano = $_POST['ano'];

        if (!empty($descricao) && !empty($ano)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO tb_turma (descricao, ano) VALUES (:descricao, :ano)");
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':ano', $ano);
                $stmt->execute();
                echo "<div class='alert alert-success mt-4'>Turma adicionada com sucesso!</div>";
                header("refresh:2;url=incturma.php");
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger mt-4'>Erro: " . $e->getMessage() . "</div>";
                header("refresh:2;url=incturma.php");
            }
        } else {
            echo "<div class='alert alert-danger mt-4'>Descrição e Ano não podem ser vazios!</div>";
            header("refresh:2;url=incturma.php");
        }
    }
    ?>
</div>
</body>
</html>
