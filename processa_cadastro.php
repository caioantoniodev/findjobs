<?php
    session_start();
    include("conexao.php");

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['rep_senha'])));
    $profissao = mysqli_real_escape_string($conexao, trim($_POST['profissao']));
    $telefone = mysqli_real_escape_string($conexao, trim(md5($_POST['telefone'])));

    $tel = limpaFFront(mysqli_real_escape_string($conexao, trim($_POST['telefone'])));
    $cpf = limpaFFront(mysqli_real_escape_string($conexao, trim($_POST['cpf'])));
    $data = limpaFFront(mysqli_real_escape_string($conexao, trim($_POST['nascimento'])));

    function limpaFFront($valor) {
      $valor = str_replace(".", "", $valor);
      $valor = str_replace(",", "", $valor);
      $valor = str_replace("-", "", $valor);
      $valor = str_replace("/", "", $valor);
      $valor = str_replace("(", "", $valor);
      $valor = str_replace(")", "", $valor);
      $valor = str_replace(" ", "", $valor);
      
      return $valor;
     }

    $sql = "SELECT COUNT(*) AS total FROM users WHERE user = '$cpf'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row['total'] == 1) {
        $_SESSION['cpf_existente'] = TRUE;
        header('Location: cadastro.php');
        exit();
    }

    $sql = "INSERT INTO users (name, user, password, date_register) VALUES ('$name', '$user', '$password', NOW())";

    if(mysqli_query($connection, $sql) === TRUE) {
        $_SESSION['bem_sucedido'] = TRUE;
    }

    mysqli_close($connection);

    header('Location: login.php');
    exit();
?>