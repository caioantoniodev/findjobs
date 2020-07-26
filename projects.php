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
                <a href="profile.php" class="dropdown-item">Profile</a>
                <div class="dropdown-divider"></div>
                <a href="index.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Log Out</a>
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
          while ($dados = mysqli_fetch_assoc($resultado)) {
          ?>
            <!--Card do Projeto-->
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
            <div class="card m-3" style="width: 21rem;height: auto;">
              <img src="<?= $dados['imgurl'] ?>" class="card-img-top p-5" alt="">
              <div class="card-body h-100">

                  <h5 class="card-title mb-1"><?= $dados['nome'] ?></h5>
                  <h6 class="card-subtitle text-muted mb-3"><?= $dados['linguagem'] ?></h6>
                  <hr>
                  <p class="card-text"><?= $dados['descricao'] ?></p>
                  <a data-toggle="modal" data-target="#modalProject">
                    <button type="button" class="btn btn-outline-dark btn-lg">I'm Interested</button>
                  </a>

              </div>
            </div>
            <?php } ?>
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