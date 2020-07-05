<?php
    session_start();
    include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Find Jobs</title>
        <link type="text/css" href="styles/style.css" rel="stylesheet">
        <link type="text/css" href="styles/loading.css" rel="stylesheet">
        <link type="text/css" href="styles/topo.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="shortcut icon" href="images/LogoBranca32.png"/>
    </head>
    <body>
        <div id="content">
            <div id="spinner"></div>
        </div>
        <header class="topo" id="conteudo">
            <img src="images/LogoAzul.png">
            <nav class="menu">
                <div class="icones">
                    <h1 class="twitter"><a href="https://twitter.com/FindJobsTCC" target="_blank"><i class="fab fa-twitter-square"></i></a></h1>
                    <h1 class="facebook"><a href="https://www.facebook.com/Find-Jobs-111396177288447/" target="_blank"><i class="fab fa-facebook-square"></i></a></h1>
                </div>
                <ul>
                    <li><a href="index.php">Inicio</a></li>

                    <!--https://celke.com.br/artigo/como-usar-funcao-empty-e-isset-no-php#:~:text=Ela%20serve%20para%20saber%20se,uma%20vari%C3%A1vel%20n%C3%A3o%20for%20vazia.&text=Exemplo%20de%20isset%20e%20empty%20usado%20para%20validar%20um%20formul%C3%A1rio.-->
                    <!-- Verifica se NÃO tem um usuario na sessao -->
                    <?php if(!isset($_SESSION['logado'])) { ?>
                        <li><a href="login.php">Login</a></li>
                         <li><a href="cadastro.php">Cadastro</a></li>
                    <?php } ?>
                    
                    <!-- Verifica se tem um usuario na sessao -->
                    <?php if(isset($_SESSION['logado'])) { ?>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="aulas.php">Aulas</a></li>
                        <li><a href="projetos.php">Projetos</a></li>
                        <li><a href="contato.php">Projetos</a></li>
                        <li><a href="sair.php">Sair</a></li>
                    <?php } ?>
                </ul>
            </nav>
            <div class="enjoy">
                <!-- Verifica se tem um usuario na sessao -->
                <?php if(isset($_SESSION['logado'])) { 
                    // pegando dados do usuário no BD    
                    $cpf = $_SESSION['cpf'];
                    $consulta = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
                    $resultado = mysqli_query($conexao, $consulta);
                    $dados = mysqli_fetch_array($resultado);    
                ?>
                    <h1>Bem vindo, <?php echo  $dados['nome'];?> !</h1>
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
                        <?php
                            // Lista os 3 ultimos criados
                            $consulta = "SELECT * FROM usuarios, projetos WHERE usuarios.cpf = projetos.cliente_cpf ORDER BY projetos.idprojetos LIMIT 3;";

                            $resultado = mysqli_query($conexao, $consulta);

                            while($dados = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <div class="projeto">
                                <img src="<?=$dados['imgurl']?>" alt="Avatar">
                                <div class="container-p">
                                    <h4><?=$dados['nome']?></h4>
                                    <p><?=$dados['linguagem']?></p>
                                    <script>alert(<?=$dados['linguagem']?>)</script>
                                    <p><?=$dados['salario']?></p>
                                    <br><p><p><?=$dados['descricao']?></p></p>
                                </div>
                            </div> 
                        <?php } ?>
                    </div>
                    <div class="button-info1">
                         <a 
                            <?php if(isset($_SESSION['logado'])) { ?>
                                href="projetos.php" 
                            <?php } else { ?>
                                href="login.php" 
                            <?php } ?>
                            class="btn2 btn-three">Veja Projetos</a>
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
                        <a 
                            <?php if(isset($_SESSION['logado'])) { ?>
                                href="aulas.php" 
                            <?php } else { ?>
                                href="login.php" 
                            <?php } ?>
                            class="btn btn-five">Acesse todo o conteúdo</a>
                    </div>
                </div>

                <div class="info3">
                    <h1>OPINIÕES<i class="fas fa-user-friends"></i></h1>
                    <p>
                        Veja a opinião das pessoas que utilizam a plataforma
                    </p>
                    <div class="opinioes">
                        <?php
                            $consulta = "SELECT * FROM usuarios, reclamacoes WHERE usuarios.cpf = reclamacoes.usuario_cpf ORDER BY reclamacoes.idreclamacoes DESC LIMIT 3;";

                            $resultado = mysqli_query($conexao, $consulta);

                            while($dados = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <div class="card">
                                <img src="<?=$dados['avatarurl']?>" alt="Avatar">
                                <div class="container">
                                    <h4><?=$dados['nome']?></h4>
                                    <p><?=$dados['profissao']?></p>
                                    <br><p><?=$dados['opniao']?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="button-info3">
                        <a 
                        <?php if(isset($_SESSION['logado'])) { ?>
                            href="avaliacoes.php" 
                        <?php } else { ?>
                            href="login.php" 
                        <?php } ?>
                        class="btn btn-six">Deixe sua avaliação</a> 
                    </div>
                </div>
            </div>
        </section>

        <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script type="text/JavaScript" src="scripts/loading.js"></script>
        <script type="text/JavaScript" src="scripts/topo.js"></script>
    </body>
</html>