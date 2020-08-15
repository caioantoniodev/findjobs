<?php
session_start();

// verifico se está logado, assim impedindo acessar direto na url
if (!isset($_SESSION['logado'])) {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Classes</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="css/projects.css" rel="stylesheet">
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
            <li class="nav-item dropdown">
              <a class="nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-user-circle"></i></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a href="profile.php" class="dropdown-item">Perfil</a>
                <div class="dropdown-divider"></div>
                <a href="sair.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>Sair</a>
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link text-white" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="projects.php">Projetos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="contact.php">Contato</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- End Navigation Bar -->

  <div class="container padding" align="center">
    <div class="row text-center justify-content-center" style="width: 100%;">
      <div class="col-12">
        <h1 class="mt-4">WELCOME TO THE CLASSES AREA!</h1>
        <p class="lead">If you need to remember or learn new things access the videos available.</p>
        <hr>
      </div>

      <!-- Our Courses-->

      <!--JAVASCRIPT-->
      <div class="col-12">
        <h4 class="mt-4">JavaScript</h4>
      </div>
      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/f--RjIOcZ_s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <!--NODE-->
      <div class="col-12">
        <hr>
        <h4 class="mt-4">NODE</h4>
      </div>
      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/qJaA5VrtN0c" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <!--PHP-->
      <div class="col-12">
        <hr>
        <h4 class="mt-4">PHP</h4>
      </div>
      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe src="https://www.youtube.com/embed/6idFzvD4pz0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <!--Recommended Channels-->
      <div class="col-12">
        <hr>
        <h4 class="mt-4">RECOMMENDED CHANNELS</h4>
      </div>

      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe src="https://www.youtube.com/embed/X7WMSfEfZGg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe src="https://www.youtube.com/embed/AqJKAJ0TKms" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe src="https://www.youtube.com/embed/FH7YrE0RjWE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe src="https://www.youtube.com/embed/RPzfYrFnauU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe src="https://www.youtube.com/embed/kjhu1LEmRpY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
        <iframe src="https://www.youtube.com/embed/ULI3-LeWSVY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

  <script type="text/JavaScript" src="js/topo.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</body>

</html>
