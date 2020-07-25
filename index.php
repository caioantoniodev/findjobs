<?php
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/topo.css" rel="stylesheet">
  <link href="css/fixed.css" rel="stylesheet">
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

            <!-- Verifica se tem um usuario na sessao -->
            <?php if (isset($_SESSION['logado'])) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-user-circle"></i></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="profile.php" class="dropdown-item">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a href="sair.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                </div>
              </li>

              <li class="nav-item active">
                <a class="nav-link text-white" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="classes.php">Classes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="projects.php">Projects</a>
              </li>
            <?php } ?>
            <!--https://celke.com.br/artigo/como-usar-funcao-empty-e-isset-no-php#:~:text=Ela%20serve%20para%20saber%20se,uma%20vari%C3%A1vel%20n%C3%A3o%20for%20vazia.&text=Exemplo%20de%20isset%20e%20empty%20usado%20para%20validar%20um%20formul%C3%A1rio.-->
            <!-- Verifica se NÃO tem um usuario na sessao -->
            <?php if (!isset($_SESSION['logado'])) { ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="login.php">Sign In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="register.php">Register</a>
              </li>
            <?php } ?>
            <!-- Verifica se tem um usuario na sessao -->
            <?php if (isset($_SESSION['logado'])) { ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="contact.php">Contact</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- End Navigation Bar -->

  <!-- Landing Page -->

  <div class="landing">
    <div class="home-wrap">
      <div class="home-inner">

      </div>
    </div>
  </div>

  <div class="caption text-center">
    <!-- Verifica se tem um usuario na sessao -->
    <?php if (isset($_SESSION['logado'])) {
      // pegando dados do usuário no BD
      $cpf = $_SESSION['cpf'];
      $consulta = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
      $resultado = mysqli_query($conexao, $consulta);
      $dados = mysqli_fetch_array($resultado);
    ?>
      <h1>Welcome, <?php echo  $dados['nome']; ?> !</h1>
    <?php } else { ?>
      <h1 class="display-2">Don't have an account yet?</h1>
      <a href="login.php"><button type="button" class="btn btn-outline-light btn-lg">Sign In</button></a>
      <a href="register.php"><button type="button" class="btn btn-light btn-lg">Register</button></a>
    <?php } ?>
  </div>

  <!-- End Landing Page -->

  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h1 class="mt-4">WHAT WILL YOU SEE HERE?</h1>
        <p class="lead">In FindJobs you'll find projects to enter in freelancer world!</p>
      </div>
      <div class="container-fluid padding" align="center">
        <div class="row justify-content-center">
          <?php if (isset($_SESSION['logado'])) { ?>
            <?php
            // Lista os 3 ultimos criados

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
            while ($dados = mysqli_fetch_assoc($resultado)) {
            ?>

              <div class="card m-3" style="width: 21rem;height: auto;">
                <img src="<?= $dados['imgurl'] ?>" class="card-img-top p-5" alt="">
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
                    <h5 class="card-title mb-1"><?= $dados['nome'] ?></h5>
                    <h6 class="card-subtitle text-muted mb-3"><?= $dados['linguagem'] ?></h6>
                    <hr>
                    <p class="card-text"><?= $dados['descricao'] ?></p>

                    <a data-toggle="modal" data-target="#modalProject"><button type="button" class="btn btn-outline-dark btn-lg">I'm Interested</button></a>

                  <?php } ?>
                </div>
              </div>
            <?php } ?>
          <?php } else { ?>
            <?php
            // Lista os 3 ultimos criados
            $consulta = "SELECT * FROM usuarios, projetos WHERE usuarios.cpf = projetos.cliente_cpf ORDER BY projetos.idprojetos DESC LIMIT 3";

            $resultado = mysqli_query($conexao, $consulta);

            while ($dados = mysqli_fetch_assoc($resultado)) {
            ?>

              <div class="card m-3" style="width: 21rem;height: auto;">
                <img src="<?= $dados['imgurl'] ?>" class="card-img-top p-5" alt="">
                <div class="card-body h-100">
                  <h5 class="card-title mb-1"><?= $dados['nome'] ?></h5>
                  <h6 class="card-subtitle text-muted mb-3"><?= $dados['linguagem'] ?></h6>
                  <hr>
                  <p class="card-text"><?= $dados['descricao'] ?></p>
                </div>
              </div>

            <?php } ?>
          <?php } ?>
        </div>
        <div class="col-12">
          <a <?php if (isset($_SESSION['logado'])) { ?> href="projects.php" <?php } else { ?> href="login.php" <?php } ?>>
            <button type="button" class="btn btn-outline-dark btn-lg">See Projects</button>
          </a>
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
                    <p>Good luck to you🚀</p>
                    <hr>

                    <button type="button" onclick="enviarEmail('<?= $email_cliente ?>', '<?= $nome_cliente ?>', '<?= $titulo_projeto ?>', '<?= $nome_freela ?>', '<?= $profissao_freela ?>')" class="btn btn-outline-dark btn-md mb-3">Send email for <?php echo $nome_cliente ?>
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
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Termos de Uso FindJobs</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra, orci aliquam hendrerit malesuada, odio magna ultricies felis, quis laoreet lectus dolor et sem. Morbi suscipit, eros non eleifend varius, velit magna ullamcorper lorem, nec mollis lacus ipsum non orci. Integer ut blandit massa, sed fermentum ipsum. Maecenas sit amet justo id ligula ullamcorper dignissim. Proin sed sollicitudin est. Morbi feugiat et nisi ut iaculis. Donec id ipsum finibus, tincidunt velit non, tincidunt quam. Nullam et nisl ut nisi interdum malesuada eget in odio. Sed fermentum, arcu eu cursus egestas, quam risus mattis tortor, dictum egestas tellus lorem vitae nulla. Sed auctor cursus finibus. Curabitur tincidunt fringilla mauris, ac laoreet ex tincidunt sit amet. Duis mollis nec mi sit amet eleifend. Sed eu purus augue. Aliquam at mi facilisis sapien blandit luctus ac in est. Mauris non risus sem.</p>

                <p>Fusce ut nibh rutrum, interdum enim ac, pulvinar odio. Nunc id est interdum, sodales sem ut, accumsan tortor. Mauris id eleifend nibh, venenatis egestas magna. Ut convallis volutpat ligula, sit amet lacinia nisl lobortis id. Nunc sollicitudin diam tellus, ac maximus ligula vehicula dictum. Nam et tincidunt sem. Vivamus faucibus sem eget urna vulputate dignissim. Duis metus lacus, pretium vitae nulla ullamcorper, lacinia fringilla leo. Pellentesque vitae magna facilisis libero scelerisque lacinia dictum id massa. Integer a eros mi. In quis sem turpis. Quisque vel dolor in lacus tristique vehicula.</p>

                <p>Mauris congue justo tempus erat finibus, quis vestibulum urna aliquet. Phasellus porttitor, enim vitae ullamcorper ultrices, nibh magna hendrerit dui, sed sodales mi tellus sed sem. Nam justo dolor, porta sed ante ac, ullamcorper iaculis justo. Donec in nulla sapien. Morbi quis placerat orci, sed dictum orci. Aenean efficitur lectus in magna blandit suscipit. Phasellus nisi eros, accumsan et aliquet sed, tristique at nulla. Suspendisse viverra odio ultricies augue lobortis vulputate. Proin a lacus vitae dui porttitor ultrices. Vestibulum sed venenatis eros. Maecenas porta hendrerit magna nec cursus. Phasellus vulputate euismod molestie. Fusce varius, libero vel luctus pellentesque, ligula nulla consequat ex, a consectetur purus enim sit amet massa. Proin enim neque, laoreet nec tellus ut, iaculis ultricies nisl.</p>

                <p>Duis interdum egestas nisi. Maecenas non pharetra arcu. Suspendisse vulputate eget eros vitae sodales. Aenean libero risus, accumsan ut vulputate tristique, accumsan quis magna. Mauris non egestas diam. Maecenas fringilla elit nisl, vel eleifend massa blandit vitae. Cras placerat justo imperdiet justo consequat, quis condimentum erat ornare. Integer porta urna ullamcorper velit tempor, ultricies vestibulum felis pulvinar. Fusce nec nisl a dolor feugiat bibendum non sed velit. Praesent ullamcorper ac orci vitae luctus. Curabitur mattis, purus vel dapibus finibus, lorem nibh tristique sapien, quis fermentum enim est sit amet tellus. Donec quis aliquet nisi. Etiam egestas metus at nunc eleifend ultrices. Integer eget finibus neque, ut ultrices ligula. Vivamus malesuada sem quis sapien mollis, ac dapibus elit commodo. Vivamus placerat massa a eros posuere, et sodales libero pulvinar.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
    <div class="container padding" align="center">
      <div class="row text-center justify-content-center" style="width: 100%;">
        <div class="col-12">
          <h1>WHAT DO WE HAVE TO OFFER?</h1>
          <P class="lead">Need to prepare for your future job or project? We have Starter course for you :)</P>
        </div>
        <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/qJaA5VrtN0c" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
          <iframe src="https://www.youtube.com/embed/6idFzvD4pz0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="embed-responsive embed-responsive-16by9 col-md-5 col-xl-3 m-2">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/f--RjIOcZ_s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-12">
          <a <?php if (isset($_SESSION['logado'])) { ?> href="classes.php" <?php } else { ?> href="login.php" <?php } ?>>
            <button type="button" class="btn btn-outline-dark btn-lg">Access All Content</button>
          </a>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <div class="row text-center justify-content-center">
        <div class="col-12">
          <h1>Opinions</h1>
          <P class="lead">See the opinion of people using the platform.</P>
        </div>
        <div class="container-fluid padding" align="center">
          <div class="row justify-content-center">
            <?php
            $consulta = "SELECT * FROM usuarios, reclamacoes WHERE usuarios.cpf = reclamacoes.usuario_cpf ORDER BY reclamacoes.idreclamacoes DESC LIMIT 3";

            $resultado = mysqli_query($conexao, $consulta);

            while ($dados = mysqli_fetch_assoc($resultado)) {
            ?>

              <div class="card m-3" style="width: 21rem;height: auto;">
                <img src="<?= $dados['avatarurl'] ?>" class="card-img-top" alt="">
                <div class="card-body h-100">
                  <h5 class="card-title mb-1"><?= $dados['nome'] ?></h5>
                  <h6 class="card-subtitle text-muted mb-3"><?= $dados['profissao'] ?></h6>
                  <hr>
                  <p class="card-text"><?= $dados['opniao'] ?></p>
                </div>
              </div>

            <?php } ?>
          </div>
        </div>
        <div class="col-12">
          <?php if (isset($_SESSION['logado'])) { ?>
            <a data-toggle="modal" data-target="#modalRate"><button type="button" class="btn btn-outline-dark btn-lg">Leave Your Review</button></a>
          <?php } ?>
        </div>
        <div class="modal fade" id="modalRate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Rate Us!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <?php
                $cpf = $_SESSION['cpf'];
                // Lista os ultimos criados
                $consulta = "SELECT usuarios.nome, usuarios.profissao FROM usuarios  WHERE usuarios.cpf = $cpf;";

                $resultado = mysqli_query($conexao, $consulta);

                $info_pessoais = mysqli_fetch_assoc($resultado);
                ?>

                <form action="evaluation_process.php" method="POST">
                  <div class="form-group">
                    <input class="form-control" type="text" name="nome_completo" id="name" placeholder="Your Name" value="<?= $info_pessoais['nome'] ?>" onkeypress="return ApenasLetras(event,this);" required="required">
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" name="profissao" id="prof" placeholder="Profession" value="<?= $info_pessoais['profissao'] ?>" onkeypress="return ApenasLetras(event,this);" required="required">
                  </div>
                  <div class="form-group">
                    <textarea id="desc" rows="5" name="opniao" placeholder="Leave Your Opinion" required="required" style="width: 100%;"></textarea>
                  </div>
                  <div class="estrelas">
                    <input type="radio" id="vazio" name="estrela" value="" checked>

                    <label for="estrela1"><i class="fas fa-star"></i></label>
                    <input type="radio" id="estrela1" name="estrela" value="1">

                    <label for="estrela2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="estrela2" name="estrela" value="2">

                    <label for="estrela3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="estrela3" name="estrela" value="3">

                    <label for="estrela4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="estrela4" name="estrela" value="4">

                    <label for="estrela5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="estrela5" name="estrela" value="5">
                  </div>
                  <div class="form-group">
                    <input type="submit" name="enviar" class="btn btn-outline-dark" id="enviar" />
                  </div>
                </form>
                <a class="link" href="contact.php">Did you have any problem?</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
    <div class="container padding" align="center">
      <div class="row text-center padding">
        <div class="col-12">
          <h2>Follow Us</h2>
        </div>
        <div class="col-12 social padding">
          <a href="https://twitter.com/FindJobsTCC"><i class="fab fa-twitter"></i></a>
          <a href="https://www.facebook.com/Find-Jobs-111396177288447/"><i class="fab fa-facebook"></i></a>
          <a href="https://www.youtube.com/channel/UCa0mtJK1hmpnK9pZmH9he-A"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <hr>
    </div>

    <!--Response evaluation-->
    <?php
    if (isset($_SESSION['avbem_sucedido'])) {
      echo "<script>alert('SUCESSO: Avaliação efetuada.');</script>";
    }
    unset($_SESSION['avbem_sucedido']);

    if (isset($_SESSION['avmal_sucedido'])) {
      echo "<script>alert('ERRO: Avaliação não efetuada.');</script>";
    }
    unset($_SESSION['avmal_sucedido']);
    ?>

    <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

    <script src="js/sentEmail.js"></script>
    <script type="text/JavaScript" src="js/topo.js"></script>
    <script type="text/JavaScript" src="js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <!--JQUERY-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="js/validacoes.js"></script>
</body>

</html>