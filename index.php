<?php
    session_start();
    include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Find Jobs</title>
        <link type="text/css" href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="shortcut icon" href="img/LogoBranca32.png"/>
    </head>
    <body>
        <header class="topo">
            <img src="img/LogoAzul.png">
            <nav class="menu">
                <div class="icones">
                    <h1 class="twitter"><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter-square"></i></a></h1>
                    <h1 class="facebook"><a href="https://pt-br.facebook.com/" target="_blank"><i class="fab fa-facebook-square"></i></a></h1>
                </div>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="">Aulas</a></li>
                    <li><a href="projetos.php">Projetos</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    
                    <!--https://celke.com.br/artigo/como-usar-funcao-empty-e-isset-no-php#:~:text=Ela%20serve%20para%20saber%20se,uma%20vari%C3%A1vel%20n%C3%A3o%20for%20vazia.&text=Exemplo%20de%20isset%20e%20empty%20usado%20para%20validar%20um%20formul%C3%A1rio.-->
                    <!-- Verifica se NÂO tem um usuario na sessao -->
                    <?php if(!isset($_SESSION['nome'])) { ?>
                        <li><a href="login.php">Login</a></li>
                         <li><a href="cadastro.php">Cadastro</a></li>
                    <?php } ?>
                    
                    <!-- Verifica se tem um usuario na sessao -->
                    <?php if(isset($_SESSION['nome'])) { ?>
                        <li><a href="sair.php">Sair</a></li>
                    <?php } ?>

                </ul>
            </nav>
            <div class="enjoy">
                <!-- Verifica se tem um usuario na sessao -->
                <?php if(isset($_SESSION['nome'])) { ?>
                    <h1>Bem vindo, <?php echo  $_SESSION['nome'];?>
                <?php } else {?>
                    <h1>Ainda Não Tem Uma Conta?</h1>
                    <div class="button">
                        <a href="login.php" class="btn btn-one">Login</a>
                        <a href="cadastro.php" class="btn btn-two">Cadastro</a>
                    </div>
                <?php } ?>
            </div>
        </header>
        <section class="conteudo">
            <div class="info">
                <div class="info1">
                    <h1>O QUE VOCÊ VERÁ AQUI?<i class="fas fa-project-diagram"></i></h1>
                    <p>
                        Na Find Jobs você encontra projetos para ingressar no mundo freelancer!
                    </p>
                    <div class="projetos">
                        <div class="projeto">
                            <img src="img/projeto.png" alt="Avatar">
                            <div class="container-p">
                                <h4>Dono</h4>
                                <p>Linguagem</p>
                                <p>Valor</p>
                                <br><p>Preciso de uma calculadora de imc</p>
                            </div>
                        </div>
                        <div class="projeto">
                            <img src="img/projeto2.png" alt="Avatar">
                            <div class="container-p">
                                <h4>Dono</h4>
                                <p>Linguagem</p>
                                <p>Valor</p>
                                <br><p>Preciso de uma calculadora de imc</p>
                            </div>
                        </div>
                        <div class="projeto">
                            <img src="img/projeto3.png" alt="Avatar">
                            <div class="container-p">
                                <h4>Dono</h4>
                                <p>Linguagem</p>
                                <p>Valor</p>
                                <br><p>Preciso de uma calculadora de imc</p>
                            </div>
                        </div>
                    </div>
                    <div class="button-info1">
                        <a href="projetos.php" class="btn2 btn-three">Veja Projetos</a>
                        <a href="" class="btn2 btn-four">Crie Projetos</a>
                    </div>
                </div>

                <div class="info2">
                    <h1>O QUE TEMOS A OFERECER?<i class="fas fa-photo-video"></i></h1>
                    <p>
                        Precisa se preparar para seu futuro trabalho ou projeto? Temos curso Starter para você :)
                    </p>
                    <div class="videos">
                        <iframe class="video1" width="280" height="157" src="https://www.youtube.com/embed/uyaV_EWWRmo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <iframe class="video2" width="280" height="157" src="https://www.youtube.com/embed/wHFflWvii3M" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <iframe class="video3" width="280" height="157" src="https://www.youtube.com/embed/HV7DtH3J2PU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="button-info2">
                        
                            <a href="" class="btn btn-five">Acesse todo o conteúdo</a>
                        
                    </div>
                </div>

                <div class="info3">
                    <h1>OPINIÕES<i class="fas fa-user-friends"></i></h1>
                    <p>
                        Veja a opinião das pessoas que utilizam a plataforma
                    </p>
                    <div class="opinioes">
                        <div class="card">
                            <img src="img/avatar.jpg" alt="Avatar">
                            <div class="container">
                                <h4>Nome</h4>
                                <p>Profissão</p>
                                <br><p>Me ajudou muito como freela, facilitou a procura por projetos.</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/avatar2.jpg" alt="Avatar">
                            <div class="container">
                                <h4>Nome</h4>
                                <p>Profissão</p>
                                <br><p>Me ajudou muito como freela, facilitou a procura por projetos.</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/avatar3.jpg" alt="Avatar">
                            <div class="container">
                                <h4>Nome</h4>
                                <p>Profissão</p>
                                <br><p>Me ajudou muito como freela, facilitou a procura por projetos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="button-info3">
                        <a href="" class="btn btn-six">Deixe sua avaliação</a>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    </body>
</html>