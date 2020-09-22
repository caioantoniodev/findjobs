<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="css/register.css" rel="stylesheet">
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
              <a class="nav-link text-white" href="login.php">Entrar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- End Navigation Bar -->

  <div class="container">
    <h1 class="display-4 mt-4">Criar sua conta</h1>
    <hr>
    <h6 class="text-muted">Preencha todos os campos corretamente</h6>

    <form class="mt-3" action="register_process.php" method="POST" enctype='multipart/form-data'>
      <h6>Dados pessoais</h6>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input class="form-control" name="nome" type="text" id="name" placeholder="Seu Nome" onkeypress="return ApenasLetras(event,this);" required="required">
        </div>
        <div class="form-group col-md-6">
          <input class="form-control"  name="nascimento" type="date" id="born" required="required">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input class="form-control" name="cpf" type="text" id="cpf" placeholder="000.000.000-00" onkeypress="$(this).mask('000.000.000-00');" required="required">
        </div>
        <div class="form-group col-md-6">
          <input class="form-control" name="profissao" type="text" id="prof" placeholder="Profissão" onkeypress="return ApenasLetras(event,this);" required="required">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input class="form-control" name="email" type="email" id="email" placeholder="seuemail@email.com" required="required">
        </div>
        <div class="form-group col-md-6">
          <input class="form-control" name="telefone" type="text" id="nbr" placeholder="(00)00000-0000" required="required" maxlength="13" onkeypress="$(this).mask('(00) 00000-0009')">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input class="form-control" name="senha" type="password" id="pass" placeholder="Sua Senha" required="required">
          <small class="text-muted">Mínimo: 8 caracteres</small>
        </div>
        <!-- <div class="form-group col-md-6">
          <input class="form-control" type="password" id="pass" placeholder="Confirm Your Password" required="required">
          <small class="text-muted">Mininal lenght: 8 characters</small>
        </div> -->
      </div>
      <hr>
      <div class="form-group">
        <label for="exp">Selecione sua experiência</label>
        <select class="form-control" name="exp" id="exp">
          <option value="Sem experiência">Sem experiência</option>
          <option value="Iniciante">Iniciante</option>
          <option value="Intermediario">Intermediário</option>
          <option value="Experiente">Experiente</option>
        </select>
      </div>
      <div class="form-group">
        <label for="image">Selecione a imagem do seu perfil</label>
        <input class="form-control" name="imagem" type="file" id="image">
        <small class="text-muted">Tamanho máximo: 3MB</small>
      </div>
      <div class="form-group">
        <label class="active">
          <input type="checkbox" autocomplete="off" required="required"> Eu li e aceito os <span class="text-info" style="text-decoration: underline; cursor: pointer;"><a data-toggle="modal" data-target="#myModal">Termos de uso</a></span>
        </label>
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

      <button type="submit" class="btn btn-info mb-3">Registrar</button>
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
  ?>

  <?php
      if (isset($_SESSION['mal_sucedido'])) {
        echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Erro!</h4>
        Não foi possível criar sua conta.</div>';
      }
      unset($_SESSION['mal_sucedido']);
  ?>

  <?php
      if (isset($_SESSION['cpf_existente'])) {
        echo '<div class="alert alert-danger fixed-top m-3 " style="transition: .1s ">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Erro!</h4>
        Já existe uma conta que utiliza esse CPF.</div>';
      }
      unset($_SESSION['cpf_existente']);
  ?>


  <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

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
