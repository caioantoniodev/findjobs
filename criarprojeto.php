<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/criar.css" rel="stylesheet">
    <link type="text/css" href="css/topo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="shortcut icon" href="img/LogoBranca32.png"/>
    <title>Criar Projeto</title>
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
            <h1>Bem vindo a area de criação de projetos</h1>
            <p>Crie um projeto para que desenvolvedores entrem para te ajudar!</p>
        </div>
    </header>
    <section>
        <div class="conteudo">
            <div class="criar">
                <form>
                    <p class="titulo">
                        Preencha os dados corretamente e aceite os termos para gerar um projeto.
                    </p>
                    <div class="dados">
                        <div class="dp">
                            <p class="nome_projeto">
                                <input type="text" name="nome_projeto" class="np" placeholder="Nome do Projeto" required="required"/>
                            </p>
                            <p class="lang">
                                <input type="text" name="lang" class="lg" placeholder="Linguagem" required="required"/>
                            </p>
                            <p class="valor">
                                <input type="text" name="valor" class="vlr" placeholder="R$ 00.000,00" required="required"/>
                            </p>
                            <p class="descricao">
                                <input type="text" name="descricao" class="desc" placeholder="Descreva seu projeto" required="required"/>
                            </p>
                            <p class="checkbox">
                                <input type="checkbox" name="checkbox" class="check"required="required"/>   Li e concordo com os <span><a href="">termos.</a></span>
                            </p>
                        </div>
                    </div>
                    <input type="submit" name="enviar" class="enviar" />
                </form>
            </div>
        </div>
    </section>

    <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script type="text/JavaScript" src="js/loading.js"></script>
    <script type="text/JavaScript" src="js/topo.js"></script>
</body>
</html>