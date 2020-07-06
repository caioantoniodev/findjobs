// Recebe o id do projeto que recebeu o onclick() e exibe um "confirm" 
function verificaDelete(Id) { 
  let id = Id; 
  if (confirm("Deseja excluir este projeto? ")) { 
    location.href=`delete.php?id=${id}`; 
  } 
}

function enviarEmail(email, nome, projeto, nomeFreela) {
  let Email = email;
  let Nome = nome;
  let Projeto = projeto;
  let nomefreela = nomeFreela;

  if(confirm(`Você deseja enviar um e-mail para ${Nome}`)) {
    location.href = `mailto:${Email}?subject=Interesse no projeto ${Projeto}&body=Olá ${Nome}! Meu nome é ${nomefreela} Sou desenvolvedor back-end e vi seu projeto ${Projeto} na plataforma Find Jobs e eu tenho interesse em ajudar.`
  }
} 
