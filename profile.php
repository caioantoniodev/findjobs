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
  <title>Perfil</title>
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
              <a class="nav-link text-white" href="classes.php">Aulas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="projects.php">Projetos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="contact.php">Contato</a>
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
                <h4 class="modal-title" id="myModalLabel">Editar seu perfil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <form action="profile_update.php" method="POST" enctype='multipart/form-data'>
                  <div class="form-group">
                    <input class="form-control" type="text" name="nome" id="name" placeholder="Seu Nome" value="<?= $dados['nome'] ?>" onkeypress="return ApenasLetras(event,this);">
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" name="profissao" id="prof" placeholder="Profissão" value=' <?php if(isset($dados['profissao'])) {  echo $dados['profissao']; } ?>' onkeypress="return ApenasLetras(event,this);">
                  </div>
                  <div class="form-group">
                    <textarea id="desc" rows="5" placeholder="Biografia" name="sobre" required="required" style="width: 100%;"><?= $dados['sobre'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" id="nbr" name="tel" placeholder="(00)00000-0000" value="<?= $dados['telefone'] ?>" required="required" maxlength="13" onkeypress="$(this).mask('(00) 00000-0009')">
                  </div>
                  <hr>
                  <h6>Redes sociais:</h6>
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
                    <label for="exp">Selecione sua experiência:</label>

                    <?php $experienciaUser = $dados['experiencia']; ?>

                    <select name="experiencia" class="form-control" id="exp">

                      <option value="Sem experiência" <?php
                                                      if ($experienciaUser == "Sem experiência") {
                                                      ?> selected="selected" <?php
                                                                            }
                                                                              ?>>Sem experiência
                      </option>


                      <option value="Iniciante" <?php
                                                if ($experienciaUser == "Iniciante") {
                                                ?> selected="selected" <?php
                                                                      }
                                                                        ?>>Iniciante
                      </option>

                      <option value="Intermediario" <?php
                                                    if ($experienciaUser == "Intermediario") {
                                                    ?> selected="selected" <?php
                                                                          }
                                                                            ?>>Intermediário
                      </option>

                      <option value="Experiente" <?php
                                                  if ($experienciaUser == "Experiente") {
                                                  ?> selected="selected" <?php
                                                                        }
                                                                          ?>>Experiente
                      </option>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="image">Selecione sua imagem de perfil:</label>
                    <input class="form-control" name="img" type="file" id="image">
                    <small class="text-muted">Tamanho máximo: 3MB</small>
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
          <h6>Biografia</h6>
          <?php if (isset($dados['sobre'])) { ?>
            <p><?= $dados['sobre'] ?></p>
          <?php } ?>
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
          <h6>Redes Sociais</h6>

          <?php if (!empty($dadosRS['github'])) { ?>
            <a target="_blank" href="https://github.com/<?= $dadosRS['github'] ?>" target="_blank">
              <i class="fab fa-github"></i>
            </a>
          <?php } ?>

          <?php if (!empty($dadosRS['twitter'])) { ?>
            <a target="_blank" href="https://twitter.com/<?= $dadosRS['twitter'] ?>">
              <i class="fab fa-twitter"></i>
            </a>
          <?php } ?>

          <?php if (!empty($dadosRS['instagram'])) { ?>
            <a target="_blank" href="https://www.instagram.com/<?= $dadosRS['instagram'] ?>">
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
        ?>
        <h3 class="mt-5">Seus projetos</h3>
        <div class="container-fluid padding" align="center">
          <div class="row justify-content-center">
            <?php
            if ($row['total'] >= 1) {
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
                    <button type="button" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#modalEditProject" data-id="<?= $projetos['idprojetos'] ?>" data-titulo="<?= $projetos['titulo'] ?>" data-descricao="<?= $projetos['descricao'] ?>" data-linguagem="<?= $projetos['linguagem'] ?>" data-repositorio="<?= $projetos['repositorio'] ?>" data-freela="<?= $projetos['cpffreela'] ?>">Editar
                    </button>
                  </div>
                </div>

              <?php } ?>
            <?php } else { ?>
              <h4 class="mt-5 text-muted">Você ainda não tem projetos</h4>
            <?php } ?>

            <div class="modal fade" id="modalEditProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <form action="project_update.php" method="POST">
                <div class="modal-dialog" role="document">
                  <div class="modal-content col-12">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Editar projeto</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                      <div class="form-row">

                        <input type="hidden" name="idProjeto" id="idProjeto">

                        <div class="form-group col-md-6">
                          <input type="text" class="form-control" name="titulo" value="" id="titulo" placeholder="Nome do projeto">
                        </div>
                        <div class="form-group col-md-6">
                          <input type="text" class="form-control" name="lang" id="lang" placeholder="Linguagem (c#, Java, etc.)">
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea name="desc" id="desc" rows="5" placeholder="Descrição do projeto" style="width: 100%;"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="repo" id="repo" placeholder="Adicione o repositório onde o código será hospedado">
                      </div>
                      <hr>
                      <h6>Adicionar um freela</h6>

                      <div class="form-group">
                        <small class="text-muted">Insira o cpf do freela</small>
                        <input class="form-control" type="text" name="cpfFreela" id="cpf" placeholder="000.000.000-00" maxlength=11>
                      </div>

                      <hr>
                      <button type="submit" class="btn btn-outline-dark btn-md mb-3">Atualizar</button>
              </form>
              <form action="project_delete.php" method="POST">
                <input type="hidden" name="idProjetoDL" id="idProjetoDL">
                <button type="submit" class="btn btn-danger btn-md mb-3">Fechar o projeto</button>
              </form>
            </div>
            <label class="active">
              <input type="checkbox" autocomplete="off" required="required"> Eu li e aceito os <span class="text-info" style="text-decoration: underline; cursor: pointer;"><a data-toggle="modal" data-target="#myModal">Termos de uso</a></span>
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
                Em caso de dúvidas, reclamações ou sugestões enviar um e-mail para a nossa equipe.</p>
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

  ?>
  <h3 class="mt-5">Projetos que você está desenvolvendo</h3>
  <div class="container-fluid padding" align="center">
    <div class="row justify-content-center">
      <?php
      if ($row['total'] >= 1) {
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
              <a href="<?= $meuFreela['repositorio'] ?>"><button type="button" class="btn btn-outline-dark btn-lg">Veja o repositório</button></a>
            </div>
          </div>
        <?php } ?>
      <?php } else { ?>
        <h4 class="mt-5 text-muted">Você não está participando de projetos</h4>
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
    Projeto criado com sucesso.</div>';
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
    Perfil não atualizado.</div>';
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
    Projeto não atualizado.</div>';
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
    Projeto não deletado.</div>';
  }
  unset($_SESSION['delete_error']);

  // MSG ATUALIZAR PROFILE
  if (isset($_SESSION['update_sucedidopf'])) {
    echo '<div class="alert alert-success fixed-top m-3 " style="transition: .6s ease-in ">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Sucesso!</h4>
    Perfil atualizado com sucesso.</div>';
  }
  unset($_SESSION['update_sucedidopf']);

  if (isset($_SESSION['update_errorpf'])) {
    echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Erro!</h4>
    Perfil não atualizado.</div>';
  }
  unset($_SESSION['update_errorpf']);



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
      modal.find('#repo').val(repositorio);
      modal.find('#cpf').val(freela);
    });
  </script>
</body>

</html>
