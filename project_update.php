<?php
  session_start();
  include("connection.php");

  $idProjeto = $_POST['idProjeto'];
  $lang = $_POST['lang'];
  $desc = $_POST['desc'];
  $repo = $_POST['repo'];
  $aux = $_POST['cpfFreela'];

  if (!empty($_POST['cpfFreela'])) {
    $query = "SELECT COUNT(*) AS total FROM usuarios WHERE cpf = $aux";
    $resultado = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($resultado);

    if ($row['total'] == 1) {
      $cpf = $_POST['cpfFreela'];
    } else {
      $_SESSION['freelaNa'] = TRUE;
      mysqli_close($conexao);
      header('Location: profile.php');
      exit();
    }

  } else {
    $cpf = NULL;
  }

  $titulo = $_POST['titulo'];

  $sql = "UPDATE projetos
      SET projetos.titulo='$titulo',
      projetos.cpffreela='$cpf',
      projetos.repositorio='$repo',
      projetos.descricao='$desc',
      projetos.linguagem='$lang'
      WHERE projetos.idprojetos = '$idProjeto'";

if (mysqli_query($conexao, $sql)) {
  $_SESSION['updatepj_sucedido'] = TRUE;
} else {
  $_SESSION['updatepj_error'] = TRUE;
}

header('Location: profile.php');
mysqli_close($conexao);
