<?php
    session_start();
    include("connection.php");

    // Verfica se todos campos estão preenchidos
    if(empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['nome']) ||
        empty($_POST['profissao']) || empty($_POST['cpf']) || empty($_POST['telefone']) ||
        empty($_POST['nascimento']) || empty($_POST['exp'])) {

        $_SESSION['campos_vazios'] = TRUE;
        header('Location: register.php');
        exit();
    }

    // Pego a imagem e movo para a pasta uploads e pego o caminho da imagem do usuario
    $destino = 'uploads/' .  $_FILES['imagem']['name'];
    $imagem = $_FILES['imagem']['tmp_name'];
    $caminho =  move_uploaded_file($imagem, $destino);

    // Pegos os campos digitados pelos usuarios e armazeno em uma variável
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    // já transformo a senha em hash MD5
    $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));
    $profissao = mysqli_real_escape_string($conexao, trim($_POST['profissao']));
    $experiencia = mysqli_real_escape_string($conexao, trim($_POST['exp']));

    // Pegos os campos digitados pelos usuarios e antes de armazenar passo para uma função
    // e limpo as formatações do JQUERY
    $tel = limpaFFront(mysqli_real_escape_string($conexao, trim($_POST['telefone'])));
    $cpf = limpaFFront(mysqli_real_escape_string($conexao, trim($_POST['cpf'])));
    $data = limpaFFront(mysqli_real_escape_string($conexao, trim($_POST['nascimento'])));

    // Função que executa a limpeza do JQUERY
    function limpaFFront($valor) {
      $valor = str_replace(".", "", $valor);
      $valor = str_replace("-", "", $valor);
      $valor = str_replace("/", "", $valor);
      $valor = str_replace("(", "", $valor);
      $valor = str_replace(")", "", $valor);
      $valor = str_replace(" ", "", $valor);

      return $valor;
     }

    // Pego o cpf passado pelo usuario e verifico se já tem uma conta cadastrado
    // com esse cpf
    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE cpf = '$cpf'";
    $resultado = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($resultado);

    // se o usuario ja for existente redireciono ele para a tela de cadastro
    if($row['total'] == 1) {
        $_SESSION['cpf_existente'] = TRUE;
        header('Location: register.php');
        exit();
    }

    //  se não for existente insiro os dados na base de dados
    $sql = "INSERT INTO usuarios (
              cpf,
              nome,
              email,
              senha,
              datanascimento,
              telefone,
              experiencia,
              avatarurl,
              profissao
            )
            VALUES (
              '$cpf',
              '$nome',
              '$email',
              '$senha',
              '$data',
              '$tel',
              '$experiencia',
              '$destino',
              '$profissao'
            )";

    if(mysqli_query($conexao, $sql) === TRUE) {
        $_SESSION['bem_sucedido'] = TRUE;
    }

    mysqli_close($conexao);
    header('Location: login.php');
    exit();
?>