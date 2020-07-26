<?php
session_start();
include_once("connection.php");

if (empty($_POST['nome_projeto']) || empty($_POST['lang']) || empty($_POST['descricao']) || empty($_POST['valor'])) {
  $_SESSION['mal_sucedido'] = TRUE;
  header('Location: create_pj_process.php');
} else {

  $nomeProjeto = trim($_POST['nome_projeto']);
  $linguagem = trim($_POST['lang']);
  $descricao = trim($_POST['descricao']);
  $valorProjeto = trim($_POST['valor']);
  $cpfCliente = trim($_POST['cpfCliente']);
  $dataEntrega = trim($_POST['dataEntrega']);
  $pagamento = trim($_POST['fPagamento']);

  // Pego a imagem e movo para a pasta uploads e pego o caminho da imagem do usuario
  $destino = 'uploads/' .  $_FILES['imagem']['name'];
  $imagem = $_FILES['imagem']['tmp_name'];
  $caminho =  move_uploaded_file($imagem, $destino);


  // Salvar no banco de dados
  $sql = "INSERT INTO projetos (
      titulo,
      descricao,
      salario,
      cpffreela,
      imgurl,
      linguagem,
      dataentrega,
      cliente_cpf,
      formapagamento
    ) VALUES  (
      '$nomeProjeto',
      '$descricao',
      '$valorProjeto',
       NULL,
      '$destino',
      '$linguagem',
      '$dataEntrega',
      '$cpfCliente',
      '$pagamento'
    )";

  if (mysqli_query($conexao, $sql) === TRUE) {
    $_SESSION['criar_sucedido'] = true;
  }

  mysqli_close($conexao);

  header("Location: profile.php");
}
