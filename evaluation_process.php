<?php
	session_start();
	include_once("connection.php");

  if(empty($_POST['nome_completo']) || empty($_POST['profissao']) || empty($_POST['opniao']) || empty($_POST['estrela'])) {
		$_SESSION['mal_sucedido'] = TRUE;
    header('Location: index.php');
  } else {
		$opn = $_POST['opniao'];

		$estrela = $_POST['estrela'];

		$cpf = $_SESSION['cpf'];

		// Salvar no banco de dados
		$sql = "INSERT INTO reclamacoes (opniao, usuario_cpf, estrelas) VALUES ('$opn', '$cpf', '$estrela')";

		if(mysqli_query($conexao, $sql) === TRUE) {
			$_SESSION['avbem_sucedido'] = true;
		}

		mysqli_close($conexao);

		header("Location: index.php");

		exit();
	}
?>

