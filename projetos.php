<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/projetos.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="css/loading.css" rel="stylesheet">
    <link type="text/css" href="css/topo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="shortcut icon" href="img/LogoBranca32.png"/>
    <title>Find Jobs</title>
</head>
<body>
    <div id="content">
        <div id="spinner"></div>
    </div>
    <header class="topo" id="conteudo">
        <img src="img/LogoAzul.png">
        <nav class="menu">
            <div class="icones">
                <h1 class="twitter"><a href="https://twitter.com/FindJobsTCC" target="_blank"><i class="fab fa-twitter-square"></i></a></h1>
                <h1 class="facebook"><a href="https://www.facebook.com/Find-Jobs-111396177288447/" target="_blank"><i class="fab fa-facebook-square"></i></a></h1>
            </div>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="aulas.html">Aulas</a></li>
                <li><a href="projetos.html">Projetos</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="cadastro.html">Cadastro</a></li>
                <li><a href="contato.html">Contato</a></li>
            </ul>
        </nav>
        <div class="enjoy">
            <h1>Bem vindo a area de projetos!</h1>
            <p>Aqui você encontra diversas opções de projetos para ingressar :)</p>
            <div class="button">
                <a href="criar.html" class="btn btn-one">Criar projeto</a>
            </div>
        </div>
    </header>
    <section>
        <div class="projetos">
            <div class="projeto">
                <img src="img/projeto.png" alt="Avatar">
                <div class="container-p">
                    <div class="icones-p">
                        <abbr title="Repositório"><a class="git" href="https://github.com/" target="_blank"><i class="fab fa-github-square"></i></a></abbr>
                    </div>
                    <h4>Dono</h4>
                    <p>Linguagem</p>
                    <p>Valor</p>
                    <br><p>Preciso de uma calculadora de imc</p>
                    <div class="button-p">
                        <a href="" class="btn-p btn-one">Tenho Interesse</a>
                    </div>
                </div>
            </div>
            <div class="projeto">
                <img src="img/projeto2.png" alt="Avatar">
                <div class="container-p">
                    <div class="icones-p">
                        <abbr title="Repositório"><a class="git" href="https://github.com/" target="_blank"><i class="fab fa-github-square"></i></a></abbr>
                        <abbr title="Editar Projeto"><a class="edit" href=""><i class="fas fa-pen-square"></i></a></abbr>
                        <abbr title="Excluir Projeto"><a class="del" href="" onclick="verificaDelete()"><i class="fas fa-minus-square"></i></i></a></abbr>
                    </div>
                    <h4>Dono</h4>
                    <p>Linguagem</p>
                    <p>Valor</p>
                    <br><p>Preciso de uma calculadora de imc</p>
                    <div class="button-p">
                        <a href="" class="btn-p btn-one">Tenho Interesse</a>
                    </div>
                </div>
            </div>
            <div class="projeto">
                <img src="img/projeto3.png" alt="Avatar">
                <div class="container-p">
                    <div class="icones-p">
                        <abbr title="Sem Repositório"><a class="s-git" href="" onclick="alert('Ops... esse projeto não possui Repositório')"><i class="fab fa-github-square"></i></a></abbr>
                    </div>
                    <h4>Dono</h4>
                    <p>Linguagem</p>
                    <p>Valor</p>
                    <br><p>Preciso de uma calculadora de imc</p>
                    <div class="button-p">
                        <a href="" class="btn-p btn-one">Tenho Interesse</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script type="text/JavaScript" src="js/loading.js"></script>
    <script type="text/JavaScript" src="js/topo.js"></script>
    <script type="text/JavaScript" src="js/script.js"></script>
</body>
</html>