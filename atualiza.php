<?php include('./bootstrap.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualiza</title>
</head>
<body>
    
<?php
include('conecta.php');

$id = $_POST['id'];
$nome = htmlspecialchars($_POST['nome']);
$cpf = htmlspecialchars($_POST['cpf']);
$rg = htmlspecialchars($_POST['rg']);
$email = htmlspecialchars($_POST['email']);
$telefone_1 = htmlspecialchars($_POST['telefone_1']);
$telefone_2 = htmlspecialchars($_POST['telefone_2']);
$dataNascimento = htmlspecialchars($_POST['dataNascimento']);

$query = "UPDATE pessoa SET nome='$nome',cpf='$cpf',rg='$rg', email='$email', telefone_1='$telefone_1', telefone_2='$telefone_2', dataNascimento ='$dataNascimento'WHERE id=$id";

$resultado = mysqli_query($conexao,$query);

?>

<div class="container mt-5">
    <?php if ($resultado) { ?>
        <div class="alert alert-success" role="alert">
            Dados Atualizados com sucesso!
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Erro ao Atualizar
        </div>
    <?php } ?>
    <a href="cad_cliente.php" class="btn btn-secondary">Voltar</a>
</div>

</body>
</html>