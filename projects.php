<?php
    session_start();
    include('connection.php');

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
  <title>Projects</title>
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
                <a href="profile.html" class="dropdown-item">Profile</a>
                <div class="dropdown-divider"></div>
                <a href="index.html" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Log Out</a>
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link text-white" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="classes.php">Classes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="contact.php">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- End Navigation Bar -->

  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h1 class="mt-4">WELCOME TO THE PROJECTS AREA!</h1>
        <p class="lead">Here you'll find several project options to join.</p>
        <hr>
        <div class="col-12">
          <a href="create.php"><button type="button" class="btn btn-outline-dark btn-lg">Create a Project</button></a>
        </div>
      </div>
      <div class="container-fluid padding" align="center">
        <div class="row justify-content-center">
          <?php
            // pegando nome e a profissao do freela
            $cpf = $_SESSION['cpf'];

            // pegando nome e a profissao do freela
            $info_freela = mysqli_query($conexao, "SELECT usuarios.nome, usuarios.profissao FROM  usuarios WHERE cpf = $cpf;");
            $dados = mysqli_fetch_assoc($info_freela);
            $nome_freela = $dados['nome'];
            $profissao_freela = $dados['profissao'];

            // listando projetos  e seus respectivos donos
            $consulta = "SELECT * FROM usuarios, projetos WHERE usuarios.cpf = projetos.cliente_cpf AND usuarios.cpf != $cpf;";

            // recebo o resutado da querie na variavel $resultado
            $resultado = mysqli_query($conexao, $consulta);

            // utilizo o while para percorrer cada card de do html e add as infos do bd
            while($dados = mysqli_fetch_assoc($resultado)) {
          ?>
            <!--Card do Projeto-->
            <div class="card m-3" style="width: 21rem;height: auto;">
              <img src="<?=$dados['imgurl']?>" class="card-img-top p-5" alt="">
              <div class="card-body h-100">
                <?php
                  // guardando alguns valores que serão utilizados
                  // pegando informações referentes ao cliente
                  $nome_cliente = $dados['nome'];
                  $email_cliente = $dados['email'];
                  $titulo_projeto = $dados['titulo'];
                  $id_projeto = $dados['idprojetos'];

                  // Verifico se o projeto está em aberto
                  if ($dados['cpffreela'] == NULL) {
                ?>
                  <h5 class="card-title mb-1"><?=$dados['nome']?></h5>
                  <h6 class="card-subtitle text-muted mb-3"><?=$dados['linguagem']?></h6>
                  <hr>
                  <p class="card-text"><?=$dados['descricao']?></p>
                  <a
                    data-toggle="modal"
                    data-target="#modalProject"
                  >
                    <button
                      type="button"
                      class="btn btn-outline-dark btn-lg">I'm Interested
                    </button>
                  </a>
                <?php } ?>
              </div>
            </div>

          <?php } ?>
        </div>
      </div>
      <div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content col-12">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Wanna join in a project?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form action="">
                <div class="form-group">
                  <p>By entering a project you agree to all terms.</p>
                  <p>Now it's up to you, you need to inform the client by email about your interest in the project.</p>
                  <p>The project owner may or may not accept you in the project.</p>
                  <p>Good luck to you</p>
                  <hr>

                  <button
                    type="button"
                    onclick="enviarEmail('<?=$email_cliente?>', '<?=$nome_cliente?>', '<?=$titulo_projeto?>', '<?=$nome_freela?>', '<?=$profissao_freela?>')"
                    class="btn btn-outline-dark btn-md mb-3"
                  >Send email for <?php echo $nome_cliente ?>
                  </button>

                  <label class="active">
                    <input type="checkbox" autocomplete="off" required="required"> I have read and accept the <span class="text-info" style="text-decoration: underline; cursor: pointer;"><a data-toggle="modal" data-target="#myModal">Terms of Use</a></span>
                  </label>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <hr>
  </div>

  <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

  <script type="text/JavaScript" src="js/topo.js"></script>
  <script src="js/sentEmail.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</body>

</html>