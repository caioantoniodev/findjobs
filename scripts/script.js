// Recebe o id do projeto que recebeu o onclick() e exibe um "confirm" 
function verificaDelete(Id) { 
  let id = Id; 
  if (confirm("Deseja excluir este projeto? ")) { 
    location.href=`delete.php?id=${id}`; 
  } 
}
