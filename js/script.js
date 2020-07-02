function verificaDelete(Id) {
    let id = Id;

    if (confirm("Deseja excluir este projeto? ")) {
      location.href=`delete.php?id=${id}`;
    }
}

function maskcpf(){
  var cpf = document.getElementById('cpf')

  if(cpf.value.length == 3 || cpf.value.length == 7){
      cpf.value += "."
  }
  
  if(cpf.value.length == 11){
    cpf.value += "-"
  }
}

