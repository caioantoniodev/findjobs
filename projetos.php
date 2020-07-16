<?php
    session_start();
    include('conexao.php');

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
    <link href="styles/projetos.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="styles/loading.css" rel="stylesheet">
    <link type="text/css" href="styles/topo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="shortcut icon" href="images/LogoBranca32.png"/>
    <title>Find Jobs</title>
</head>
<body>
    <div id="content">
        <div id="spinner"></div>
    </div>
    <header class="topo">
        <img src="images/LogoAzul.png">
        <nav class="menu">
            <div class="icones">
                <h1 class="twitter"><a href="https://twittercom/" target="_blank"><i class="fab fa-twitter-square"></i></a></h1>
                <h1 class="facebook"><a href="https://pt-br.facebook.com/" target="_blank"><i class="fab fa-facebook-square"></i></a></h1>
            </div>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="projetos.php">Projetos</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="sair.php">Sair</a></li>
            </ul>
        </nav>
        <div class="enjoy">
            <h1>Bem vindo a area de projetos!</h1>
            <p>Aqui você encontra diversas opções de projetos para ingressar :)</p>
            <div class="button">
                <a href="criar_projeto.php" class="btn btn-one">Criar projeto</a>
            </div>
        </div>
    </header>
    <section>
        <div class="projetos">
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
                while($dados = mysqli_fetch_assoc($resultado)) {
            ?>
                <div class="projeto">
                    <img src="<?=$dados['imgurl']?>" alt="Avatar">
                    <div class="container-p">
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
                            <h4><?=$dados['nome']?></h4>
                            <p><?=$dados['linguagem']?></p>
                            <p><?="R$ ".$dados['salario']?></p>
                            <p><?=$dados['titulo']?></p>
                            <br><p><p><?=$dados['descricao']?></p></p>
                            
                            <!--Botao que redireciona o freela para o email do cliente-->
                            <div class="button-p">
                                <a onclick="enviarEmail('<?=$email_cliente?>', '<?=$nome_cliente?>', '<?=$titulo_projeto?>', '<?=$nome_freela?>', '<?=$profissao_freela?>')" class="btn-p btn-one">Tenho Interesse</a>
                            </div>
                        <?php } ?>
                    </div>
                </div> 
            <?php } ?>
        </div>
    </section>
    
    <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script type="text/JavaScript" src="scripts/loading.js"></script>
    <script type="text/JavaScript" src="scripts/topo.js"></script>
    <script type="text/JavaScript" src="scripts/script.js"></script>
</body>
</html>