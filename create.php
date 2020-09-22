<?php
session_start();
include('connection.php');

// verifico se está logado, assim impedindo acessar direto na url
if (!isset($_SESSION['logado'])) {
  header('Location: index.php');
}

// obtenho o cpf do cliente cadastrado
$cpfCliente = $_SESSION['cpf'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar projeto</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="css/create.css" rel="stylesheet">
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

  <div class="container">
    <h1 class="display-5 mt-4">Crie um projeto para que os desenvolvedores cadastrados possam ajudar você.</h1>
    <hr>
    <h6 class="text-muted">Preencha os dados corretamente e aceite os termos para gerar um projeto</h6>
    <form class="mt-5" action="create_pj_process.php" method="POST" enctype='multipart/form-data'>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input type="text" class="form-control" name="nome_projeto" id="projectName" placeholder="Nome do projeto" required="required">
        </div>
        <div class="form-group col-md-6">
          <input type="text" class="form-control" name="lang" id="lang" placeholder="Linguagem (c#, Java, etc.)" required="required">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input class="form-control" name="dataEntrega" type="date" id="born" required="required">
          <small class="text-muted">Data de entrega</small>
        </div>
      </div>
      <div class="form-group">
        <textarea id="desc" rows="5" name="descricao" placeholder="Descrição do projeto" required="required" style="width: 100%;"></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input type="text" class="form-control" name="valor" id="price" placeholder="Valor do projeto">
        </div>
        <div class="form-group col-md-6">
          <select class="form-control" name="fPagamento" id="payment">
            <option value="Paypal">Paypal</option>
            <option value="Boleto Bancário">Boleto</option>
            <option value="Cartão de Credito">Cartão de crédito</option>
          </select>
        </div>
      </div>
      <!--Input invisivel que passa o cpf do cliente para a pagina que processa que os dados-->
      <input type="hidden" name="cpfCliente" value="<?= $cpfCliente ?>" />
      <div class="form-group">
        <label for="image">Selecione uma imagem para o seu projeto</label>
        <input class="form-control" name="imagem" type="file" id="image">
        <small class="text-muted">Max. size: 3MB</small>
      </div>
      <div class="form-group">
        <label class="active">
          <input type="checkbox" autocomplete="off" required="required"> Eu li e aceito os <span class="text-info" style="text-decoration: underline; cursor: pointer;"><a data-toggle="modal" data-target="#myModal">Termos de uso</a></span>
        </label>
      </div>
      <button type="submit" class="btn btn-info mb-3">Criar</button>
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
    </form>
  </div>

  <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

  <script type="text/JavaScript" src="js/bootstrap.bundle.min.js"></script>
  <script type="text/JavaScript" src="js/topo.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <!--JQUERY-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</body>

</html>
