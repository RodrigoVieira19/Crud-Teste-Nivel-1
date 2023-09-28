<?php include('./bootstrap.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    
<?php
include('conecta.php');

$id = $_GET['id'];

$query = "SELECT * FROM pessoa WHERE id = $id";

$resultado = mysqli_query($conexao, $query);

$dados = mysqli_fetch_assoc($resultado);
?>

<div class="container mt-5">
    <!-- formulzrio atualizar dados -->
    <form action="atualiza.php" method="POST" onsubmit="return confirm('Tem certeza que deseja atualizar os dados?')">
        <input type="hidden" name="id" value="<?php echo $dados['id'];?>">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $dados['nome'];?>" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" name="cpf" value="<?php echo $dados['cpf'];?>" required>
        </div>
        <div class="form-group">
            <label for="rg">RG:</label>
            <input type="text" class="form-control" name="rg" value="<?php echo $dados['rg'];?>" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $dados['email'];?>" required>
        </div>
        <div class="form-group">
            <label for="telefone_1">Telefone 1:</label>
            <input type="tel" class="form-control" name="telefone_1" value="<?php echo $dados['telefone_1'];?>" required>
        </div>
        <div class="form-group">
            <label for="telefone_2">Telefone 2:</label>
            <input type="tel" class="form-control" name="telefone_2" value="<?php echo $dados['telefone_2'];?>" required>
        </div>
        <div class="form-group">
            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" class="form-control" name="dataNascimento" value="<?php echo $dados['dataNascimento'];?>" >
        </div>
        <div class="row">
            <div class="col-md-6">
                <input class="btn btn-primary atualizar" type="submit" value="Atualizar Dados">
            </div>
            <div class="col-md-6">
                <a href="cad_cliente.php" class="btn btn-secondary float-right">Voltar</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
