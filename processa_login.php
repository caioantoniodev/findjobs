<?php
  session_start();
  include('conexao.php');

  // impede que o usuario acesse essa pagina com os 
  // campos 'usuario' e 'senha' vazio 
  if(empty($_POST['email']) || empty($_POST['senha'])) {
    $_SESSION['campos_vazios'] = TRUE;
    header('Location: login.php');
    exit();
  }

  // pega os campos vindos do form da index e esse metodo protege 
  // contra sql inject
  $email = mysqli_real_escape_string($conexao, $_POST['email']);
  $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

  // faz a consulta no banco de dados
  $consulta = "SELECT cpf FROM usuarios WHERE email = '{$email}' AND senha = md5('{$senha}');";

  // verifica o resultado da query
  $resultado = mysqli_query($conexao, $consulta);

  // verifica a quantidade de linhas retornadas da query
  $linha = mysqli_num_rows($resultado);

  if ($linha === 1) {
    $cpf =  mysqli_fetch_array($resultado);
    // inicio 2 sessoes contendo cpf o status de logado;
    $_SESSION['cpf'] = $cpf['cpf'];
    $_SESSION['logado'] = TRUE;
    header('Location: index.php');
  } else {
    $_SESSION['mal_sucedido'] = TRUE;
    header('Location: login.php');
    exit();
  }
?>

