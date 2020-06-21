<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/cadastro.css" type="text/css" rel="stylesheet">
	<link rel="shortcut icon" href="_img/_icones/LogoAzul32.png"/>
    <title>Cadastrar</title>
</head>
<body>
    <section>
        <div class="conteudo">
            <div class="cadastro">
                <form>
                    <img class="user" src="img/user_cdst.png">
                    <p>
                        <h1 class="txt1">Preencha os campos corretamente para realizar o cadastro</h1>
                    </p>
                    <div class="dados">
                        <div class="dp">
                            <label>Dados Pessoais</label>
                            <p class="nome_completo">
                                <input type="text" name="nome_completo" class="nc" placeholder="Nome completo" required="required"/>
                            </p>
                            <p class="email">
                                <input type="email" name="email" class="em" placeholder="E-mail" required="required"/>
                            </p>
                            <p class="nasc">
                                <input type="date" name="nasc" class="nasc" required="required"/>
                            </p>
                            <p class="nmr">
                                <input type="tel" name="nmr" class="tel" placeholder="Celular" required="required"/>
                            </p>
                        </div>
                        <div class="dp2">
                            <p class="cpf">
                                <input type="number" name="cpf" class="cpf" placeholder="CPF" required="required"/>
                            </p>
                            <p class="email">
                                <input type="email" name="email" class="em" placeholder="E-mail" required="required"/>
                            </p>
                            <p class="nasc">
                                <input type="date" name="nasc" class="nasc" required="required"/>
                            </p>
                            <p class="nmr">
                                <input type="tel" name="nmr" class="tel" placeholder="Celular" required="required"/>
                            </p>
                        </div>
                        <div class="dp3">
                            <label>Nivel de experiência</label>
                            <div class="experiencia">
                                <input class="iniciante" type="radio" name="rb1" value="iniciante"> Iniciante
                                <input class="intermedio" type="radio" name="rb2" value="intermedio"> Intermediario
                                <input class="experiente" type="radio" name="rb3" value="experiente"> Experiente
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="enviar" class="enviar" />
                </form>
                <div class="links">
                    <br><a class="st" href="index.php">Inicio</a>
                    <a class="cdst" href="login.php">Login</a>
                </div>
            </div>
        </div>
</body>
</html>