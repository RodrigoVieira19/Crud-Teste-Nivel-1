<?php
include('conecta.php');

//impedir que o usuario consiga acessar o localhost
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    $query = "UPDATE pessoa SET status = 'inativo' WHERE id = '$id'";
    
    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        header("Location: cad_cliente.php"); // voltar para página principal
        exit(); // sair
    } else {
        echo "Erro ao desativar usuário";
    }
} else {
    echo "Erro";
}
?>
