<?php

  if(empty($_POST['nome_projeto']) || empty($_POST['lang']) || empty($_POST['descricao']) || empty($_POST['valor'])) {
    $_SESSION['mal_sucedido'] = TRUE;
    header('Location: index.php');
  }  else {
    $nomeProjeto = trim($_POST['nome_projeto']);
    $linguagem = trim($_POST['lang']);
    $descricao = trim($_POST['descricao']);
    $valorProjeto = trim($_POST['valor']);
    
    echo $nomeProjeto;
    $_SESSION['bem_sucedido'] = TRUE;
    header('Location: index.php');
  }
?>