<?php

  session_start();
  include("connection.php");

  $cpf = $_SESSION['cpf'];

  $nome = $_POST['nome'];
  $profissao = $_POST['profissao'];
  $sobre = $_POST['sobre'];
  $tel = $_POST['tel'];
  $exp = $_POST['experiencia'];

  $sql = "UPDATE usuarios
          SET usuarios.nome='$nome',
              usuarios.profissao='$profissao',
              usuarios.sobre='$sobre',
              usuarios.telefone='$tel',
              usuarios.experiencia='$exp'
          WHERE usuarios.cpf = '$cpf'";

  $github = $_POST['github'];
  $twiter = $_POST['twitter'];
  $instagram = $_POST['instagram'];

    // Pego o cpf passado pelo usuario e verifico se já tem as redes socias cadastradas
    // com esse cpf
    $query = "SELECT COUNT(*) AS total FROM redes_sociais WHERE usuarios_cpf = '$cpf'";
    $resultado = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($resultado);

    if($row['total'] == 1) {
      $sql2 = "UPDATE 	redes_sociais
        SET instagram = '$instagram',
        twitter = '$twiter',
        github = '$github'
        WHERE usuarios_cpf = $cpf";
    } else {
      $sql2 = "INSERT INTO redes_sociais (
        github,
        instagram,
        twitter,
        usuarios_cpf
      ) VALUES  (
        '$github',
        '$twiter',
        '$instagram',
        '$cpf'
      )";
    }

    if (empty($_FILES['img']['name'])) {
      // listando projetos  desse usuário
      $consulta = "SELECT usuarios.avatarurl FROM usuarios WHERE usuarios.cpf = $cpf";

      // recebo o resutado da querie na variavel $resultado
      $resultado = mysqli_query($conexao, $consulta);

      $img = mysqli_fetch_assoc($resultado);

      $url = $img['avatarurl'];


      $sql3 = "UPDATE usuarios
        SET avatarurl = '$url'
        WHERE usuarios.cpf = $cpf";
    } else {
      // Pego a imagem e movo para a pasta uploads e pego o caminho da imagem do usuario
      $destino = 'uploads/' .  $_FILES['img']['name'];
      $imagem = $_FILES['img']['tmp_name'];
      $caminho =  move_uploaded_file($imagem, $destino);

      echo $destino;

      $cons= "UPDATE usuarios SET avatarurl = '$destino' WHERE usuarios.cpf = $cpf";
    }

    if (mysqli_query($conexao, $sql) && mysqli_query($conexao, $sql2) && mysqli_query($conexao, $cons)) {
      $_SESSION['update_sucedido'] = TRUE;
    } else {
      $_SESSION['update_error'] = TRUE;
    }

  header('profile.php');
  mysqli_close($conexao);
?>