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
  <title>Projetos</title>
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
              <a class="nav-link text-white" href="classes.php">Aulas</a>
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

  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h1 class="mt-4">BEM VINDO A ÁREA DE PROJETOS!</h1>
        <p class="lead">Aqui você encontrará várias opções de projeto para ingressar.</p>
        <hr>
        <div class="col-12">
          <a href="create.php"><button type="button" class="btn btn-outline-dark btn-lg">Criar um projeto</button></a>
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
                if ($dados['cpffreela'] == NULL || $dados['cpffreela'] == 0) {
            ?>
            <div class="card m-3" style="width: 21rem;height: auto;">
              <img src="<?= $dados['imgurl'] ?>" class="card-img-top p-5" alt="">
              <div class="card-body h-100">

                  <h5 class="card-title mb-1"><?= $dados['nome'] ?></h5>
                  <h6 class="card-subtitle text-muted mb-3"><?= $dados['linguagem'] ?></h6>
                  <hr>
                  <p class="card-text"><?= $dados['descricao'] ?></p>
                  <a data-toggle="modal" data-target="#modalProject">
                    <button type="button" class="btn btn-outline-dark btn-lg">Tenho interesse</button>
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

                  <button type="button" onclick="enviarEmail('<?= $email_cliente ?>', '<?= $nome_cliente ?>', '<?= $titulo_projeto ?>', '<?= $nome_freela ?>', '<?= $profissao_freela ?>')" class="btn btn-outline-dark btn-md mb-3">Enviar um email para <?php echo $nome_cliente ?>
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
                Em caso de dúvidas, reclamações ou sugestões enviar um e-mail para a nossa equipe.</p>
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
