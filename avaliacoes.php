<?php
    session_start();
    include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="css/avaliacoes.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="css/loading.css" rel="stylesheet">
    <link type="text/css" href="css/topo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="shortcut icon" href="img/LogoBranca32.png"/>
    <title>Avaliações</title>
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
                <li><a href="index.php">Inicio</a></li>
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="projetos.php">Projetos</a></li>
                <li><a href="contato.php">Projetos</a></li>
                <li><a href="sair.php">Sair</a></li>>
            </ul>
        </nav>
        <div class="enjoy">
            <h1>Bem vindo a area de avaliações</h1>
            <p>De sua avaliação do que você achou do nosso site.</p>
        </div>
    </header>
    <section>
        <div class="conteudo">
            <div class="avaliacoes">
                <form action="processa_avaliacao.php" method="POST">
                    <p class="titulo">
                        Preencha os dados corretamente e deixe sua avaliação.
                    </p>
                    <div class="dados">
                        <div class="dp">
                            <?php
                                 $cpf = $_SESSION['cpf'];
                                // Lista os ultimos criados
                                $consulta = "SELECT usuarios.nome, usuarios.profissao FROM usuarios  WHERE usuarios.cpf = $cpf;";

                                $resultado = mysqli_query($conexao, $consulta);

                                $info_pessoais = mysqli_fetch_assoc($resultado);
                            ?>
                            <p class="nome_completo">
                                <input type="text" name="nome_completo" class="nc" placeholder="Nome Completo" value="<?=$info_pessoais['nome']?>" required="required"/>
                            </p>
                            <p class="profissao">
                                <input type="text" name="profissao" class="prof" placeholder="Profissão" value="<?=$info_pessoais['profissao']?>" required="required"/>
                            </p>
                            <p class="opiniao">
                                <input type="text" name="opniao" class="opn" placeholder="Deixe sua opinião" required="required"/>
                            </p>
                            <div class="estrelas">
                                <input type="radio" id="vazio" name="estrela" value="" checked>

                                <label for="estrela1"><i class="fa"></i></label>
                                <input type="radio" id="estrela1" name="estrela" value="1">

                                <label for="estrela2"><i class="fa"></i></label>
                                <input type="radio" id="estrela2" name="estrela" value="2">

                                <label for="estrela3"><i class="fa"></i></label>
                                <input type="radio" id="estrela3" name="estrela" value="3">

                                <label for="estrela4"><i class="fa"></i></label>
                                <input type="radio" id="estrela4" name="estrela" value="4">

                                <label for="estrela5"><i class="fa"></i></label>
                                <input type="radio" id="estrela5" name="estrela" value="5">

                            </div>

                            <input type="submit" name="enviar" class="enviar" id="enviar" />
                            <a class="link" href="contato.php">Teve algum problema?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <button onclick="backToTop()" id="btnTop"><i class="fas fa-arrow-up"></i></button>

    <?php
		if (isset($_SESSION['bem_sucedido'])) {
            echo "<script>alert('SUCESSO: Avaliação efetuada.');</script>";
        }
        unset($_SESSION['bem_sucedido']);

        if (isset($_SESSION['mal_sucedido'])) {
            echo "<script>alert('ERRO: Avaliação não efetuada.');</script>";
        }
        unset($_SESSION['mal_sucedido']);
    ?>
    <script type="text/JavaScript" src="js/loading.js"></script>
    <script type="text/JavaScript" src="js/topo.js"></script>
</body>
</html>