<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" type="text/css" rel="stylesheet">
    <link type="text/css" href="css/loading.css" rel="stylesheet">
    <link type="text/css" href="css/topo.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/LogoBranca32.png"/>
    <title>Login</title>
</head>
<body>
    <section>
        <div id="content">
            <div id="spinner"></div>
        </div>
        <div class="conteudo" id="conteudo">
            <div class="login">
                <img class ="user" src="img/user.png">
                <form action="processa_login.php" method="POST">
                    <p>
                        <h1 class="txt1">Entre em sua conta</h1>
                    </p>
                    <p class="email">
                        <label for="email">Insira seu e-mail</label><br>
                        <input type="email" name="email" class="em" placeholder="seuemail@email.com" required="required" />
                    </p>
                    <p class="senha">
                        <label for="senha">Insira sua senha</label><br>
                        <input type="password" name="senha" class="ps" placeholder="Senha" required="required" />
                    </p>
                    <input type="submit" name="enviar" class="enviar" />
                </form>
                <div class="links">
                    <a class="fgt "href="#">Esqueceu sua senha?</a><br>
                    <br><a class="st" href="index.php">Inicio</a>
                    <a class="cdst" href="cadastro.php">Cadastrar</a>
                </div>
            </div>
        </div>
    </section>

    <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

    <script type="text/JavaScript" src="js/loading.js"></script>
    <script type="text/JavaScript" src="js/topo.js"></script>
</body>
</html>