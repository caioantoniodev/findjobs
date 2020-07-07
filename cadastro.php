<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/cadastro.css" type="text/css" rel="stylesheet">
    <link type="text/css" href="styles/loading.css" rel="stylesheet">
    <link type="text/css" href="styles/topo.css" rel="stylesheet">
	<link rel="shortcut icon" href="images/LogoBranca32.png"/>
    <title>Cadastrar</title>
</head>
<body>
    <div id="content">
        <div id="spinner"></div>
    </div>
    <section>
        <div class="conteudo" id="conteudo">
            <div class="cadastro">
                <form>
                    <img class="user" src="images/user_cdst.png">
                    <p>
                        <h1 class="txt1">Preencha os campos corretamente para realizar o cadastro</h1>
                    </p>

                    <div class="dados">
                        <div class="dp">
                            <p>Dados Pessoais:</p>
                            <br><input type="text" class="nc" name="nome" placeholder="Nome Completo" required="required" />
                            <input type="text" class="prof" name="profissao" placeholder="Profissão" required="required" />
                            <input type="email" class="em" name="email" placeholder="seuemail@email.com" required="required" />
                            <input type="tel" class="tel" id="cel" name="telefone" placeholder="(00)0000-0000" required="required" maxlength="13" onkeypress="$(this).mask('(00) 00000-0009')" />
                            <input type="text" class="cpf" id="cpf" name="cpf" placeholder="000.000.000-00" required="required" maxlength="14" onkeypress="$(this).mask('000.000.000-00')" />
                            <input type="date" class="nasc" name="nascimento" required="required" />
                            <input type="password" class="pss" name="senha" placeholder="Sua Senha" required="required" minlength="8" />
                            <input type="password" class="pss" name="senha" placeholder="Confirme sua Senha" required="required" minlength="8" />
                        </div>

                        <div class="exp">
                            <p>Nivel de experiência profissional:</p>
                            <input type="radio" class="rb" name="exp" value="sem_exp">
                            <label for="sem_exp">Sem experiência</label>
                            <br><input type="radio" class="rb" name="exp" value="iniciante">
                            <label for="iniciante">Iniciante</label>
                            <br><input type="radio" class="rb" name="exp" value="intermediario">
                            <label for="intermediario">Intermediario</label>
                            <br><input type="radio" class="rb" name="exp" value="experiente">
                            <label for="experiente">Experiente</label>
                            <br><input type="submit" name="enviar" class="enviar" />
                            <div class="links">
                                <br><a class="st" href="index.html">Inicio</a>
                                <a class="cdst" href="login.html">Login</a>
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>

        <!---Se mal sucedido--->
        <?php 
            if (isset($_SESSION['campos_vazios'])) {
                echo "<script>alert('ERRO: Preencha todos os campos.');</script>";
            }
            unset($_SESSION['campos_vazios']);
        ?>
		
        <?php 
            if (isset($_SESSION['mal_sucedido'])) {
                echo "<script>alert('ERRO: Preencha todos os campos.');</script>";
            }
            unset($_SESSION['mal_sucedido']);
        ?>

        <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

        <script type="text/JavaScript" src="scripts/script.js"></script>
        <script type="text/JavaScript" src="scripts/loading.js"></script>
        <script type="text/JavaScript" src="scripts/topo.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</body>
</html>