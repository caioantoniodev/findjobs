<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entrar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="css/login.css" rel="stylesheet">
  <link href="css/topo.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/LogoBranca32.png" />
</head>

<body>

  <!-- Navigation Bar -->

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-info sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand mr-auto" href="index.php"><img src="img/LogoAzul.png"></a>
        <button class="navbar-toggler" type="button" style="border:none;" data-toggle="collapse" data-target="#navbarResponsive">
          <spam class="navbar-toggler-icon"></spam>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item active">
              <a class="nav-link text-white" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="register.php">Cadastrar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- End Navigation Bar -->

  <div class="container">
    <h1 class="display-4 mt-4">Faça login em sua conta</h1>
    <hr>
    <h6 class="text-muted">Preencha todos os campos corretamente</h6>

    <form class="mt-4" action="login_process.php" method="POST">
      <div class="form-group">
        <label for="email">E-mail</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="email@email.com" required="required">
      </div>
      <div class="form-group">
        <label for="senha">Senha</label>
        <input class="form-control" type="password" name="senha" id="senha" placeholder="Sua senha" required="required">
        <a class="p-1" href="#">Esqueceu sua senha?</a>
      </div>
      <button type="submit" class="btn btn-info mb-3">Entrar</button>
    </form>
  </div>

  <!---Se mal sucedido--->
  <?php
    if (isset($_SESSION['campos_vazios'])) {
      echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <h4 class="alert-heading">Erro!</h4>
      Preencha todos os campos.</div>';
    }
    unset($_SESSION['campos_vazios']);

    if (isset($_SESSION['mal_sucedido'])) {
      echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <h4 class="alert-heading">Erro!</h4>
      O Email ou senha inseridos são inválidos.</div>';
    }
    unset($_SESSION['mal_sucedido']);

    // MSG CRIAR CONTA
    if (isset($_SESSION['bem_sucedido'])) {
      echo '<div class="alert alert-success fixed-top m-3" style="transition: .6s ease-in">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <h4 class="alert-heading">Sucesso!</h4>
      Sua conta foi criada.</div>';
    }
    unset($_SESSION['bem_sucedido']);
  ?>


  <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

  <script type="text/JavaScript" src="js/topo.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</body>

</html>
