<?php
    session_start();
    include('conexao.php');

    if (!isset($_SESSION['logado'])) {
      header('Location: index.php');
    } 

    $cpf_cliente = $_SESSION['cpf'];

    $consulta = "SELECT * FROM projetos";

    $resultado = mysqli_query($conexao, $consulta);

    while($dados = mysqli_fetch_assoc($resultado)) {
      echo "Achei o ID: ".$dados['idProjeto'];
    }
?>