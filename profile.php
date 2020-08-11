<?php
session_start();
include('connection.php');

// verifico se está logado, assim impedindo acessar direto na url
if (!isset($_SESSION['logado'])) {
  header('Location: index.php');
}

// obtenho o cpf do usuario
$cpf = $_SESSION['cpf'];

// listando informações pessoais do usuário
$consulta = "SELECT * FROM usuarios WHERE usuarios.cpf = '$cpf'";
$resultado = mysqli_query($conexao, $consulta);
$dados = mysqli_fetch_assoc($resultado);

// listando as redes sociais do usuário
$consulta = "SELECT * FROM redes_sociais WHERE redes_sociais.usuarios_cpf = '$cpf'";
$resultado = mysqli_query($conexao, $consulta);
$dadosRS = mysqli_fetch_assoc($resultado);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="css/profile.css" rel="stylesheet">
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
              <a class="nav-link text-white" href="classes.php">Classes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="projects.php">Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <abbr title="Log Out"><a class="nav-link text-white" href="sair.php"><i class="fas fa-sign-out-alt"></i></a></abbr>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- End Navigation Bar -->

  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-xl-4 justify-content-center" align="center">
        <img src="<?= $dados['avatarurl'] ?>" style="width: 300px;height: 300px;border-radius: 10px;">
        <div class="row justify-content-center text-center">
          <h3 class="mt-2"><?= $dados['nome'] ?></h3>
          <a data-toggle="modal" data-target="#modalEdit"><i class="fas fa-edit m-3" style="cursor: pointer;"></i></a>
        </div>
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <form action="profile_update.php" method="POST" enctype='multipart/form-data'>
                  <div class="form-group">
                    <input class="form-control" type="text" name="nome" id="name" placeholder="Your Name" value="<?= $dados['nome'] ?>" onkeypress="return ApenasLetras(event,this);">
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" name="profissao" id="prof" placeholder="Profession" value="<?= $dados['profissao'] ?>" onkeypress="return ApenasLetras(event,this);">
                  </div>
                  <div class="form-group">
                    <textarea id="desc" rows="5" placeholder="About You" name="sobre" required="required" style="width: 100%;"><?= $dados['sobre'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" id="nbr" name="tel" placeholder="(00)00000-0000" value="<?= $dados['telefone'] ?>" required="required" maxlength="13" onkeypress="$(this).mask('(00) 00000-0009')">
                  </div>
                  <hr>
                  <h6>Social Media:</h6>
                  <div class="form-row justify-content-center">
                    <a class="social-media mr-2" href="#"><i class="fab fa-github"></i></a>
                    <div class="form-group">
                      <input type="text" class="form-control" name="github" id="GitHub" <?php
                                                                                        if (!empty($dadosRS['github'])) {
                                                                                        ?> value="<?= $dadosRS['github'] ?>" <?php
                                                                                                                            }
                                                                                                                              ?> placeholder="GitHub_User">
                    </div>
                  </div>

                  <div class="form-row justify-content-center">
                    <a class="social-media mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <div class="form-group">
                      <input type="text" class="form-control" name="twitter" <?php
                                                                              if (!empty($dadosRS['twitter'])) {
                                                                              ?> value="<?= $dadosRS['twitter'] ?>" <?php
                                                                                                                  }
                                                                                                                    ?> id="Twitter" placeholder="Twitter_User">
                    </div>
                  </div>
                  <div class="form-row justify-content-center">
                    <a class="social-media mr-2" href="#"><i class="fab fa-instagram"></i></a>
                    <div class="form-group">
                      <input type="text" class="form-control" name="instagram" <?php
                                                                                if (!empty($dadosRS['instagram'])) {
                                                                                ?> value="<?= $dadosRS['instagram'] ?>" <?php
                                                                                                                      }
                                                                                                                        ?> id="Instagram" placeholder="Instagram_User">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="exp">Select your experience</label>

                    <?php $experienciaUser = $dados['experiencia']; ?>

                    <select name="experiencia" class="form-control" id="exp">

                      <option value="Sem experiência" <?php
                                                      if ($experienciaUser == "Sem experiência") {
                                                      ?> selected="selected" <?php
                                                                            }
                                                                              ?>>Without experience
                      </option>


                      <option value="Iniciante" <?php
                                                if ($experienciaUser == "Iniciante") {
                                                ?> selected="selected" <?php
                                                                      }
                                                                        ?>>Rookie
                      </option>

                      <option value="Intermediario" <?php
                                                    if ($experienciaUser == "Intermediario") {
                                                    ?> selected="selected" <?php
                                                                          }
                                                                            ?>>Intermedian
                      </option>

                      <option value="Experiente" <?php
                                                  if ($experienciaUser == "Experiente") {
                                                  ?> selected="selected" <?php
                                                                        }
                                                                          ?>>Experient
                      </option>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="image">Select a image for your profile</label>
                    <input class="form-control" name="img" type="file" id="image">
                    <small class="text-muted">Max. size: 3MB</small>
                  </div>
                  <hr>
                  <div class="form-group">
                    <input type="submit" name="enviar" class="btn btn-outline-dark" id="enviar" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="border p-2">
          <h6>About</h6>
          <p><?= $dados['sobre'] ?></p>
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
        </div>
        <div class="col-12 social padding mt-2">
          <h6>Social Media</h6>

          <?php if (!empty($dadosRS['github'])) { ?>
            <a href="<?= $dadosRS['github'] ?>" target="_blank">
              <i class="fab fa-github"></i>
            </a>
          <?php } ?>

          <?php if (!empty($dadosRS['twitter'])) { ?>
            <a href="<?= $dadosRS['twitter'] ?>">
              <i class="fab fa-twitter"></i>
            </a>
          <?php } ?>

          <?php if (!empty($dadosRS['instagram'])) { ?>
            <a href="<?= $dadosRS['instagram'] ?>">
              <i class="fab fa-instagram"></i>
            </a>
          <?php } ?>
        </div>
      </div>
      <div class="col-xl-8 justify-content-center" align="center">
        <?php
        $query = "SELECT COUNT(*) AS total FROM projetos WHERE cliente_cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $query);
        $row = mysqli_fetch_assoc($resultado);

        if ($row['total'] >= 1) {
        ?>
          <h3>Own Projects</h3>
          <div class="container-fluid padding" align="center">
            <div class="row justify-content-center">
              <?php
              // listando projetos  desse usuário
              $consulta = "SELECT * FROM usuarios, projetos WHERE usuarios.cpf = projetos.cliente_cpf AND usuarios.cpf = $cpf;";

              // recebo o resutado da querie na variavel $resultado
              $resultado = mysqli_query($conexao, $consulta);

              // utilizo o while para percorrer cada card de do html e add as infos do bd
              while ($projetos = mysqli_fetch_assoc($resultado)) {
              ?>


                <div class="card m-3" style="width: 21rem;height: auto;">
                  <img src="<?= $projetos['imgurl'] ?>" class="card-img-top p-5" alt="">
                  <div class="card-body h-100">
                    <h5 class="card-title mb-1"><?= $projetos['titulo'] ?></h5>
                    <h6 class="card-subtitle text-muted mb-3"><?= $projetos['linguagem'] ?></h6>
                    <hr>
                    <p class="card-text"><?= $projetos['descricao'] ?></p>
                    <button
                      type="button"
                      class="btn btn-outline-dark btn-lg"
                      data-toggle="modal" data-target="#modalEditProject"
                      data-id="<?= $projetos['idprojetos'] ?>"
                      data-titulo="<?= $projetos['titulo'] ?>"
                      data-descricao="<?= $projetos['descricao'] ?>"
                      data-linguagem="<?= $projetos['linguagem'] ?>"
                      data-repositorio="<?= $projetos['repositorio'] ?>"
                      data-freela="<?= $projetos['cpffreela'] ?>">Editar
                    </button>
                  </div>
                </div>

              <?php } ?>
            <?php } ?>

            <div class="modal fade" id="modalEditProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="project_update.php" method="POST">
              <div class="modal-dialog" role="document">
                <div class="modal-content col-12">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>

                    <div class="modal-body">
                      <div class="form-row">

                        <input type="hidden" name="idProjeto" id="idProjeto">

                        <div class="form-group col-md-6">
                          <input type="text" class="form-control" name= "titulo" value="" id="titulo" placeholder="Project Name">
                        </div>
                        <div class="form-group col-md-6">
                          <input type="text" class="form-control" name="lang" id="lang" placeholder="Language (c#, Java, etc.)">
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea name="desc" id="desc" rows="5" placeholder="Project Description" style="width: 100%;"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="repo" id="repository" placeholder="Add your GitHub Repository">
                      </div>
                      <hr>
                      <h6>Add a Participant</h6>

                      <div class="form-group">
                        <small class="text-muted">Insert the participant's cpf</small>
                        <input class="form-control" type="text" name="cpfFreela" id="cpf" placeholder="000.000.000-00" maxlength=11>
                      </div>

                    <hr>
                    <button type="submit" class="btn btn-outline-dark btn-md mb-3">Confirm</button>
                  </form>
                  <form action="project_delete.php" method="POST">
                    <input type="hidden" name="idProjetoDL" id="idProjetoDL">
                    <button type="submit" class="btn btn-danger btn-md mb-3">Delete Project</button>
                  </form>
                  </div>
                  <label class="active">
                      <input type="checkbox" autocomplete="off" required="required"> I have read and accept the <span class="text-info" style="text-decoration: underline; cursor: pointer;"><a data-toggle="modal" data-target="#myModal">Terms of Use</a></span>
                  </label>
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
          <?php
          $query = "SELECT COUNT(*) AS total FROM projetos WHERE cpffreela = '$cpf'";
          $resultado = mysqli_query($conexao, $query);
          $row = mysqli_fetch_assoc($resultado);

          if ($row['total'] >= 1) {
          ?>
            <h3 class="mt-5">Participating</h3>
            <div class="container-fluid padding" align="center">
              <div class="row justify-content-center">

                <?php
                // listando projetos  desse usuário
                $consulta = "SELECT * FROM usuarios, projetos WHERE usuarios.cpf = projetos.cliente_cpf AND projetos.cpffreela = $cpf";

                // recebo o resutado da querie na variavel $resultado
                $resultado = mysqli_query($conexao, $consulta);

                // utilizo o while para percorrer cada card de do html e add as infos do bd
                while ($meuFreela = mysqli_fetch_assoc($resultado)) {
                ?>

                  <div class="card m-3" style="width: 21rem;height: auto;">
                    <img src="img/delivery2.png" class="card-img-top p-5" alt="">
                    <div class="card-body h-100">
                      <h5 class="card-title mb-1"><?= $meuFreela['titulo'] ?></h5>
                      <h6 class="card-subtitle text-muted mb-3"><?= $meuFreela['linguagem'] ?></h6>
                      <hr>
                      <p class="card-text"><?= $meuFreela['descricao'] ?>.</p>
                      <a href="<?= $meuFreela['repositorio'] ?>"><button type="button" class="btn btn-outline-dark btn-lg">See Repository</button></a>
                    </div>
                  </div>

                <?php } ?>
              <?php } ?>
              </div>
            </div>
      </div>
    </div>
  </div>

  <?php
  // MSG CRIAR PROJETO
  if (isset($_SESSION['criar_sucedido'])) {
    echo '<div class="alert alert-success fixed-top m-3" style="transition: .6s ease-in">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Sucesso!</h4>
    Project created with sucess.</div>';
  }
  unset($_SESSION['criar_sucedido']);

  // MSG ATUALIZAR UM PROJETO
  if (isset($_SESSION['update_sucedido'])) {
    echo '<div class="alert alert-success fixed-top m-3" style="transition: .6s ease-in">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Sucesso!</h4>
    Projeto atualizado com sucesso.</div>';
  }
  unset($_SESSION['update_sucedido']);

  if (isset($_SESSION['update_error'])) {
    echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Erro!</h4>
    Perfil não atualizado!</div>';
  }
  unset($_SESSION['update_error']);

  // MSG ATUALIZAR UM PROJETO
  if (isset($_SESSION['updatepj_sucedido'])) {
    echo '<div class="alert alert-success fixed-top m-3" style="transition: .6s ease-in">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Sucesso!</h4>
    Projeto atualizado com sucesso.</div>';
  }
  unset($_SESSION['updatepj_sucedido']);

  if (isset($_SESSION['updatepj_error'])) {
    echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Erro!</h4>
    Projeto não atualizado!</div>';
  }
  unset($_SESSION['updatepj_error']);

  // MSG DELETAR UM PROJETO
  if (isset($_SESSION['delete_sucedido'])) {
    echo '<div class="alert alert-warning fixed-top m-3 " style="transition: .6s ease-in ">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Sucesso!</h4>
    Projeto deletado.</div>';
  }
  unset($_SESSION['delete_sucedido']);

  if (isset($_SESSION['delete_error'])) {
    echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Erro!</h4>
    Projeto não deletado!</div>';
    echo "<script>alert('ERROR: Project not deleted');</script>";
  }
  unset($_SESSION['delete_error']);

  // MSG FREELANCER NÂO ENCONTRADO
  if (isset($_SESSION['freelaNa'])) {
    echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .18s ease-out">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Erro!</h4>
    Freelancer não encontrado.</div>';
  }
  unset($_SESSION['freelaNa']);
  ?>

  <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script src="js/validacoes.js"></script>
  <script type="text/JavaScript" src="js/topo.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

  <!--Inserir dados no modal-->
  <script type="text/javascript">
    $('#modalEditProject').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget);
      let id = button.data('id');
      let titulo = button.data('titulo');
      let descricao = button.data('descricao');
      let linguagem = button.data('linguagem');
      let repositorio = button.data('repositorio');
      let freela = button.data('freela');

      const modal = $(this);

      modal.find('#idProjeto').val(id);
      modal.find('#idProjetoDL').val(id);
      modal.find('#titulo').val(titulo);
      modal.find('#desc').val(descricao);
      modal.find('#lang').val(linguagem);
      modal.find('#repository').val(repositorio);
      modal.find('#cpf').val(freela);
    });
  </script>
</body>

</html>
