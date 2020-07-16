<?php
	session_start();
  include_once("conexao.php");
  
  if(empty($_POST['nome_projeto']) || empty($_POST['lang']) || empty($_POST['descricao']) || empty($_POST['valor'])) {
    $_SESSION['mal_sucedido'] = TRUE;
    header('Location: index.php');
  }  else {

    $nomeProjeto = trim($_POST['nome_projeto']);

    $linguagem = trim($_POST['lang']);

    $descricao = trim($_POST['descricao']);

    $valorProjeto = trim($_POST['valor']);

    $cpfCliente = trim($_POST['cpfCliente']);
    
		// Salvar no banco de dados
    $sql = "INSERT INTO projetos (titulo, descricao, salario, cpffreela, imgurl, linguagem, dataentrega, cliente_cpf) VALUES
    ('$nomeProjeto', '$descricao', '$valorProjeto', NULL, 'https://image.flaticon.com/icons/svg/2909/2909653.svg', '$linguagem', '2021-12-30', '$cpfCliente');";
    
    if(mysqli_query($conexao, $sql) === TRUE) {
			$_SESSION['bem_sucedido'] = true;
		} 
	
		mysqli_close($conexao);
	
		header("Location: projetos.php");
  }
?>