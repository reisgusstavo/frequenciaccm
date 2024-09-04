<?php
include 'conectar.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conectar();
$sql = "SELECT * FROM tb_turma";

// executo a consulta
$stmt = $pdo->query($sql);
$stmt->execute();
$resultado = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Inclusão de Grupo</title>
    <link rel ="stylesheet" href="css/aluno.css">

</head>
<body>
    
<div class="container">
    <div class= "form-image"> 
         <img src="img/imgaluno.svg"> 
    </div>
<div class="form">
   <form method="post">
     <div class="form-group">
        <div class="title">
            <h1>Cadastro de Alunos</h1>
        </div>

        <div class="input-group">


    <div class="input-box">
            <label>Nome:</label>
            <input type="text" name="nomealuno" placeholder="Insira o nome do aluno" >
    </div>
    <div class="input-box">
            <label>Celular Aluno</label>
            <input type="text" name="celularAluno" placeholder="(xx) xxxx-xxxx" >
    </div>
    <div class="input-box">
            <label>Celular Responsavel</label>
            <input type="text" name="celularResponsavel" placeholder="(xx) xxxx-xxxx" >
    </div>
    <div class="input-box">
            <label>Data de nascimento</label>
            <input type="date" name="dtnascimento" placeholder="Insira a data de nascimento do aluno(a)" >
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Turma</label>
      <select class="form-control" name="turma">
        <option selected>Escolha a Turma</option>
        <?php foreach($resultado as $r){ ?>
        <option value=<?php echo $r['idturma'];?>><?php echo $r['descricao'];?></option>
        <?php }?>
      </select>
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

    $nomealuno = $_POST['nomealuno'];
    $celularAluno = $_POST['celularAluno'];
    $celularResponsavel = $_POST['celularResponsavel'];
    $dtnascimento = $_POST['dtnascimento'];

    if (!empty($nomealuno) && !empty($celularAluno) && !empty($celularResponsavel) && !empty($dtnascimento)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_aluno(nomealuno, celularAluno, celularResponsavel, dtnascimento) VALUES (:nomealuno, :celularAluno, :celularResponsavel, :dtnascimento)");
            $stmt->bindParam(':nomealuno', $nomealuno);
            $stmt->bindParam(':celularAluno', $celularAluno);
            $stmt->bindParam(':celularResponsavel', $celularResponsavel);
            $stmt->bindParam(':dtnascimento', $dtnascimento);
            $stmt->execute();
            echo "Aluno(a) cadastrado com sucesso!";
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Os campos não pode estar vazios!";
    }
}
?>