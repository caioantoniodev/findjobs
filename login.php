<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/login.css" type="text/css" rel="stylesheet">
    <link type="text/css" href="styles/loading.css" rel="stylesheet">
    <link type="text/css" href="styles/topo.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/LogoBranca32.png"/>
    <title>Login</title>
</head>
<body>
    <section>
        <div id="content">
            <div id="spinner"></div>
        </div>
        <div class="conteudo" id="conteudo">
            <div class="login">
                <img class ="user" src="images/user.png">
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

    <!---Se mal sucedido--->
    <?php 
        if (isset($_SESSION['campos_vazios'])) {
            echo "<script>alert('ERRO: Preencha todos os campos.');</script>";
        }
        unset($_SESSION['campos_vazios']);
    ?>

    <?php 
        if (isset($_SESSION['mal_sucedido'])) {
            echo "<script>alert('ERRO: Usuário ou senha incorretos.');</script>";
        }
        unset($_SESSION['mal_sucedido']);
    ?>

    <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

    <script type="text/JavaScript" src="scripts/loading.js"></script>
    <script type="text/JavaScript" src="scripts/topo.js"></script>
</body>
</html>