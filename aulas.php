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
    <link href="styles/aulas.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="styles/loading.css" rel="stylesheet">
    <link type="text/css" href="styles/topo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="shortcut icon" href="images/LogoBranca32.png"/>
    <title>Aulas</title>
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
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="projetos.php">Projetos</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="sair.php">Sair</a></li>
            </ul>
        </nav>
        <div class="enjoy">
            <h1>Bem vindo a area de aulas</h1>
            <p>Se precisar relembrar ou aprender coisas novas acesse os vídeos disponíveis.</p>
        </div>
    </header>
    <section>
        <div class="conteudo">
            <div class="info">
                <h1>Aulas disponíveis<i class="fas fa-photo-video"></i></h1>

                <p>
                    Hiren's Boot
                </p>

                <div class="videos">
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/embed/nzievuc3-EI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/embed/8LoSLzHftas" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/embed/sZk4kdnqX3s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/embed/xcgIBfdO2FI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/embed/PMlxrWxc1P8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/embed/NMnuYAslJ0U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>

                <p>
                    PHP
                </p>

                <div class="videos">
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/watch?v=nzievuc3-EI&list=PLHRSwc96e-nDVcfXYRRBp7ltqfIvFGBhi&index=2&t=0s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/watch?v=8LoSLzHftas&list=PLHRSwc96e-nDVcfXYRRBp7ltqfIvFGBhi&index=2" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/watch?v=sZk4kdnqX3s&list=PLHRSwc96e-nDVcfXYRRBp7ltqfIvFGBhi&index=3" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/watch?v=xcgIBfdO2FI&list=PLHRSwc96e-nDVcfXYRRBp7ltqfIvFGBhi&index=4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/watch?v=PMlxrWxc1P8&list=PLHRSwc96e-nDVcfXYRRBp7ltqfIvFGBhi&index=5" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="video" width="280" height="157" src="https://www.youtube.com/watch?v=NMnuYAslJ0U&list=PLHRSwc96e-nDVcfXYRRBp7ltqfIvFGBhi&index=6" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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