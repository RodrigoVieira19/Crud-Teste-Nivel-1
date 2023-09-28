<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro</title>
    <?php include('./bootstrap.php'); ?>
</head>
<body>

<!-- Header -->
<header style="background-color: var(--cor-pri-claro); color: white;" class="py-3 text-center">
    <h2>Sistema de Cadastro</h2>
</header>
<!-- Header -->

<!--Cadastrar novo usuario -->
<div class="container mt-4">
    <h1>Cadastrar</h1>
    <form action="cadastrar.php" method="POST">
        <div class="row">
            <div class="col-md-6">             
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF válido (XXX.XXX.XXX-XX)" required>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rg">RG:</label>
                        <input type="text" class="form-control" name="rg" id="rg" placeholder="RG" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Digite o e-mail" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefone1">Telefone 1:</label>
                        <input type="tel" class="form-control" name="telefone_1" id="telefone1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefone2">Telefone 2:</label>
                        <input type="tel" class="form-control" name="telefone_2" id="telefone2" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dataNascimento">Data de Nascimento:</label>
                        <input type="date" class="form-control" name="dataNascimento" id="dataNascimento" required>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary mt-4">Cadastrar</button>
                </div>
            </div>
        </form>
    <!--Cadastrar novo usuario -->

    <!--Lista de clientes -->
    <h2 class="mt-5">Lista de Clientes:</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>E-Mail</th>
                <th>Telefone 1</th>
                <th>Telefone 2</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>

            <?php
            include('conecta.php');
            //adicionar ativo/inativo
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['desativar'])) {
                    $idDesativar = $_POST['id_desativar'];
                    $queryDesativar = "UPDATE pessoa SET status = 'inativo' WHERE id = $idDesativar";
                    $resultadoDesativar = mysqli_query($conexao, $queryDesativar);

                    if ($resultadoDesativar) {
                        echo '<script>alert("Usuário desativado com sucesso.");</script>';
                        echo '<meta http-equiv="refresh" content="0">'; 
                    } else {
                        echo '<script>alert("Erro ao desativar o usuário.");</script>';
                    }
                } elseif (isset($_POST['ativar'])) {
                    $idAtivar = $_POST['id_ativar'];
                    $queryAtivar = "UPDATE pessoa SET status = 'ativo' WHERE id = $idAtivar";
                    $resultadoAtivar = mysqli_query($conexao, $queryAtivar);

                    if ($resultadoAtivar) {
                        echo '<script>alert("Usuário ativado com sucesso.");</script>';
                        echo '<meta http-equiv="refresh" content="0">'; 
                    } else {
                        echo '<script>alert("Erro ao ativar o usuário.");</script>';
                    }
                }
            }
            //adicionar ativo/inativo

            // Mostrar pela ordem de cadastro
            $query = "SELECT id, nome, cpf, rg, email, telefone_1, telefone_2, dataNascimento, status FROM pessoa ORDER BY id ASC";
            $resultado = $conexao->query($query);

            //adicionar uma linha cinza caso o usario esteja inativo(desativado)
            while ($linha = $resultado->fetch_assoc()) {
                $classeLinha = ($linha['status'] === 'inativo') ? 'linha-cinza' : '';

                echo '<tr class="' . $classeLinha . '" data-id="' . $linha['id'] . '">';
                echo '<td>'.$linha['nome'].'</td>';
                echo '<td>'.$linha['cpf'].'</td>';
                echo '<td>'.$linha['rg'].'</td>';
                echo '<td>'.$linha['email'].'</td>';
                echo '<td>'.$linha['telefone_1'].'</td>';
                echo '<td>'.$linha['telefone_2'].'</td>';
                echo '<td>'.date('d/m/Y', strtotime($linha['dataNascimento'])).'</td>'; 
                echo '<td>';
                echo '<div class="btn-group btn-group-sm">';
                echo '<a href="edita.php?id='.$linha['id'].'" class="btn btn-primary" >Editar</a>'; 
                if ($linha['status'] == 'ativo') {
                    echo '<form action="" method="POST">';
                    echo '<input type="hidden" name="id_desativar" value="'.$linha['id'].'">';
                    echo '<button type="submit" name="desativar" class="btn ml-1" style="background: var(--cor-pri-claro); color: #fff;">Desativar</button>';
                    echo '</form>';
                } else {
                    echo '<form action="" method="POST">';
                    echo '<input type="hidden" name="id_ativar" value="'.$linha['id'].'">';
                    echo '<button type="submit" name="ativar" class="btn btn-info ml-1">Ativar</button>';
                    echo '</form>';
                }
                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
