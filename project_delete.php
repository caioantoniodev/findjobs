<?php
session_start();
include("connection.php");

$idProjeto = $_POST['idProjetoDL'];

echo $idProjeto;

$sql = "DELETE FROM projetos WHERE projetos.idprojetos = '$idProjeto'";

if (mysqli_query($conexao, $sql)) {
  $_SESSION['delete_sucedido'] = TRUE;
} else {
  $_SESSION['delete_error'] = TRUE;
}

header('Location: profile.php');
mysqli_close($conexao);
