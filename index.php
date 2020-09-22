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
                  <a href="profile.php" class="dropdown-item">Perfil</a>
                  <div class="dropdown-divider"></div>
                  <a href="sair.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>Sair</a>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link text-white" href="classes.php">Aulas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="projects.php">Projetos</a>
              </li>

              <li class="nav-item">
                <a class="nav-link text-white" href="contact.php">Contato</a>
              </li>

            <?php } ?>
            <!--https://celke.com.br/artigo/como-usar-funcao-empty-e-isset-no-php#:~:text=Ela%20serve%20para%20saber%20se,uma%20vari%C3%A1vel%20n%C3%A3o%20for%20vazia.&text=Exemplo%20de%20isset%20e%20empty%20usado%20para%20validar%20um%20formul%C3%A1rio.-->
            <!-- Verifica se NÃO tem um usuario na sessao -->
            <?php if (!isset($_SESSION['logado'])) { ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="login.php">Entrar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="register.php">Cadastrar</a>
              </li>
            <?php } ?>
            <!-- Verifica se tem um usuario na sessao -->
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
      <h1>Bem-vindo, <?php echo  $dados['nome']; ?> !</h1>
    <?php } else { ?>
      <h1 class="display-2">Ainda não tem uma conta ?</h1>
      <a href="login.php"><button type="button" class="btn btn-outline-light btn-lg">Entrar</button></a>
      <a href="register.php"><button type="button" class="btn btn-light btn-lg">Cadastrar</button></a>
    <?php } ?>
  </div>

  <!-- End Landing Page -->

  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h1 class="mt-4">O que você verá aqui?</h1>
        <p class="lead">Na FindJobs você encontrará projetos para entrar no mundo freelancer!</p>
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
              <?php
              // guardando alguns valores que serão utilizados
              // pegando informações referentes ao cliente
              $nome_cliente = $dados['nome'];
              $email_cliente = $dados['email'];
              $titulo_projeto = $dados['titulo'];
              $id_projeto = $dados['idprojetos'];

              // Verifico se o projeto está em aberto
              if ($dados['cpffreela'] == NULL || $dados['cpffreela'] == 0) {
              ?>
                <div class="card m-3" style="width: 21rem;height: auto;">
                  <img src="<?= $dados['imgurl'] ?>" class="card-img-top p-5" alt="">
                  <div class="card-body h-100">

                    <h5 class="card-title mb-1"><?= $dados['nome'] ?></h5>
                    <h6 class="card-subtitle text-muted mb-3"><?= $dados['linguagem'] ?></h6>
                    <hr>
                    <p class="card-text"><?= $dados['descricao'] ?></p>

                    <a data-toggle="modal" data-target="#modalProject"><button type="button" class="btn btn-outline-dark btn-lg">Estou interessado</button></a>


                  </div>
                </div>
              <?php } ?>
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
            <button type="button" class="btn btn-outline-dark btn-lg">Veja todos projetos</button>
          </a>
        </div>
        <div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Quer participar de um projeto?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <form action="">
                  <div class="form-group">
                    <p>Ao entrar em um projeto, você concorda com todos os termos.</p>
                    <p>Agora cabe a você informar o cliente por e-mail sobre o seu interesse no projeto. O proprietário do projeto pode ou não aceitar você no projeto.</p>
                    <p>Boa sorte 🚀</p>
                    <hr>

                    <button type="button" onclick="enviarEmail('<?= $email_cliente ?>', '<?= $nome_cliente ?>', '<?= $titulo_projeto ?>', '<?= $nome_freela ?>', '<?= $profissao_freela ?>')" class="btn btn-outline-dark btn-md mb-3">Enviar email para <?php echo $nome_cliente ?>
                    </button>

                    <label class="active">
                      <input type="checkbox" autocomplete="off" required="required"> Eu li e aceito os <span class="text-info" style="text-decoration: underline; cursor: pointer;"><a data-toggle="modal" data-target="#myModal">Termos de uso</a></span>
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
                <p>A FindJobs é uma plataforma que tem como objetivo conectar o freelancer ao cliente que necessita de seus trabalhos,
                fazendo com que encontrem freelancers aptos e capazes de fazer um trabalho profissional.
                Um freelancer é todo ser humano que trabalha por conta e se cadastra na plataforma com o intuito de prestar trabalhos ao cliente.
                Um cliente é todo ser humano ou empresa que se cadastra na plataforma com o intuito de procurar um freelancer para prestar um trabalho.
                Para o Contratante(cliente/empresa) e o contratado(freelancer) o cadastro será gratuito, porém se um deles desejar colocar um projeto
                na plataforma será descontado um total de 3% do preço total do projeto inserido. Após a criação do projeto será possível editar todas
                as suas informações exceto o preço do projeto, o mesmo será fixo e não poderá ser mudado; poderá ser colocado um imagem para melhor
                localização do projeto, um título para ajudar a quem está procurando o projeto e uma breve descrição sobre o projeto e as especificações
                do que se precisa para o projeto. Ao termino de um projeto, será pago ao freelancer o valor proposto pelo contratante, logo após isso
                terá uma aba para dar uma nota ou reportar um parceiro de trabalho por comportamento indevido, em seguida o projeto será fechado e se
                o comportamento for positivo ele continuará com as estrelas positivas no perfil podendo até aumentar em alguns casos, se o comportamento
                for negativo ele receberá um aviso e se o mesmo persistir ele perderá estrelas até ser banido. Em caso de fraudes ou ghost dentro da plataforma,
                não haverá tolerância e o usuário vigente terá um banimento de 60 dias, se esse comportamento persistir ele será banido permanentemente do
                servidor não não podendo usar o CPF para se cadastrar impossibilitando de fazer o cadastro de uma conta nova no servidor. Se algum usuário for
                denunciado por mal comportamento ou quebrar alguma regra sua pontuação de estrelas decairá, se a mesma chegar a 0, ele receberá um aviso dizendo
                que se esse comportamento persistir ele receberá um banimento permanente e se houver algum incidente após isso o usuário receberá um banimento
                permanente, isso também vale para se um usuário denunciar outro por um motivo e após uma validação, ser verificado que esse motivo é falso, o
                usuário que fez a denúncia receberá o banimento. Quanto parte de direitos autorais, o cliente/contratante possui todos os direitos autorais
                sobre o projeto vigente, o freelancer/contratado por outro  lado não possui direitos sobre o produto final porém possui todos os direitos sobre
                a sua parte do projeto que lhe foi designada. A FindJobs não se responsabiliza por quaisquer contratos feitos fora da plataforma, problemas e
                contratempos que não estejam contabilizados dentro da plataforma, em caso de algum problema que esteja dentro da plataforma, favor contatar a empresa.
                Em caso de dúvidas, reclamações ou sugestões enviar um e-mail para o SAC</p>
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
          <h1>O QUE TEMOS A OFERECER ?</h1>
          <P class="lead">Precisa se preparar para seu futuro trabalho ou projeto? Temos curso para você aprimorar suas habilidades.</P>
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
            <button type="button" class="btn btn-outline-dark btn-lg">Acessar todo conteúdo</button>
          </a>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <div class="row text-center justify-content-center">
        <div class="col-12">
          <h1>Opniões</h1>
          <P class="lead">Veja as opniões de quem estão utilizando a nossa plataforma.</P>
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
            <a data-toggle="modal" data-target="#modalRate"><button type="button" class="btn btn-outline-dark btn-lg">Deixe sua opnião</button></a>
          <?php } ?>
        </div>
        <div class="modal fade" id="modalRate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nos avalie!</h4>
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
                    <input class="form-control" type="text" name="nome_completo" id="disabledTextInput" placeholder="Seu nome" value="<?= $info_pessoais['nome'] ?>" disabled >
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" name="profissao" id="disabledTextInput" placeholder="Profissão" value="<?= $info_pessoais['profissao'] ?>" disabled >
                  </div>
                  <div class="form-group">
                    <textarea id="desc" rows="5" name="opniao" placeholder="Sua opnião" required="required" style="width: 100%;"></textarea>
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
                    <input type="submit" name="enviar" class="btn btn-outline-dark" id="enviar" value="enviar" />
                  </div>
                </form>
                <a class="link" href="contact.php">Você teve um problema?</a>
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
          <h2>Siga-nos</h2>
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
      echo '<div class="alert alert-success fixed-top m-3" style="transition: .6s ease-in">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <h4 class="alert-heading">Sucesso!</h4>
      Avaliação efetuada.</div>';
    }
    unset($_SESSION['avbem_sucedido']);

    if (isset($_SESSION['avmal_sucedido'])) {
      echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <h4 class="alert-heading">Erro!</h4>
      Avaliação não efetuada.</div>';
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
