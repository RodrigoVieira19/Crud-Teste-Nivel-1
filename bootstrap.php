<?php
    //arquivo com algumas confs de estilo/btn etc
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    :root {
        --cor-pri-claro: #ff8b1f; /* laranja claro */
        --cor-pri-escuro: #ff6500; /* laranja escuro */
        --cor-sec-claro: #0060b1; /* azul claro */
        --cor-sec-escuro: #004d8e; /* azul escuro */
    }
    
    .btn {
        font-size: 16px !important;
        line-height: 24px !important;
    }
    
    .table .thead-dark th {
        background-color: var(--cor-pri-claro);
        border-color: #ffffff;
    }

    /*caso desative algum usuario, o usuario ficara inativo e recebera a cor cinza */
    .linha-cinza {
        background-color: #dedede; 
    }

    .table-bordered td, .table-bordered th {
    border: 1px solid #a6a6a6;  
}
</style>
