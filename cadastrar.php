<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conecta.php');
    $nome = htmlspecialchars($_POST['nome']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $rg = htmlspecialchars($_POST['rg']);
    $email = htmlspecialchars($_POST['email']);
    $telefone_1 = htmlspecialchars($_POST['telefone_1']);
    $telefone_2 = htmlspecialchars($_POST['telefone_2']);
    $dataNascimento = htmlspecialchars($_POST['dataNascimento']);

    $cpfErro = false;
    $rgErro = false;
    $emailErro = false;

    // Verificar se o cpf, rg e email ja existem no banco de dados
    $verificaCpf = "SELECT * FROM pessoa WHERE cpf = '$cpf'";
    $verificaRg = "SELECT * FROM pessoa WHERE rg = '$rg'";
    $verificaEmail = "SELECT * FROM pessoa WHERE email = '$email'";

    $resultadoVerificaCpf = mysqli_query($conexao, $verificaCpf);
    $resultadoVerificaRg = mysqli_query($conexao, $verificaRg);
    $resultadoVerificaEmail = mysqli_query($conexao, $verificaEmail);

    if (mysqli_num_rows($resultadoVerificaCpf) > 0) {
        $cpfErro = true;
    }

    if (mysqli_num_rows($resultadoVerificaRg) > 0) {
        $rgErro = true;
    }

    if (mysqli_num_rows($resultadoVerificaEmail) > 0) {
        $emailErro = true;
    }

    if ($cpfErro || $rgErro || $emailErro) {
        $mensagemErro = "Erro: ";
        if ($cpfErro) {
            $mensagemErro .= "CPF já cadastrado. ";
        }
        if ($rgErro) {
            $mensagemErro .= "RG já cadastrado. ";
        }
        if ($emailErro) {
            $mensagemErro .= "E-Mail já cadastrado. ";
        }
        $mensagemErro .= "Por favor, verifique os campos e tente novamente.";
    } else {
        // Se os campos CPF, RG e email não estiverem cadastrados entao adicionar os dados
        $sql = "INSERT INTO pessoa(nome, cpf, rg, email, telefone_1, telefone_2, dataNascimento) values('$nome','$cpf', '$rg','$email','$telefone_1', '$telefone_2','$dataNascimento')";

        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            $mensagemSucesso = "Usuário cadastrado com sucesso!";
        } else {
            $mensagemErro = "Erro ao cadastrar usuário. Por favor, tente novamente.";
        }

        mysqli_close($conexao);
    }
} else {
    header('Location: cad_cliente.php'); // evitar que o usuario acesse pelo localhost outras paginas
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <?php include('./bootstrap.php'); ?>
</head>
<body>
    <div class="container mt-4">
        <?php if (isset($mensagemErro)) { ?>
            <div class="alert alert-danger" role="alert">
                <strong>Erro:</strong> <?php echo $mensagemErro; ?>
            </div>
        <?php } elseif (isset($mensagemSucesso)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensagemSucesso; ?>
            </div>
        <?php } ?>
        <a class="btn btn-primary" href="cad_cliente.php">Voltar</a>
    </div>
</body>
</html>
