<?php
  // Criando a conexão com o servidor do MySQL Windows
  $conexao = mysqli_connect('localhost', 'root', '', 'findjobs') 
    or die ('Não foi possível acessar o BD');
  // Criando a conexão com o servidor do MySQL Linux Docker
  // $conexao = mysqli_connect('172.17.0.2', 'root', '', 'findjobs') 
  //   or die ('Não foi possível acessar o BD');
?>