function verificaDelete(Id) {
  let id = Id;

  if (confirm("Deseja excluir este projeto? ")) {
    location.href = `delete.php?id=${id}`;
  }
}

function enviarEmail(email, nome, projeto, nomeFreela, profFreela) {
  let Email = email;
  let Nome = nome;
  let Projeto = projeto;
  let Nomefreelancer = nomeFreela;
  let ProfFreelancer = profFreela;

  if (confirm(`Você deseja enviar um e-mail para ${Nome}`)) {
    location.href = `mailto:${Email}?subject=Interesse no projeto ${Projeto}&body=Olá ${Nome}! Meu nome é ${Nomefreelancer} Sou ${ProfFreelancer} e vi seu projeto ${Projeto} na plataforma Find Jobs e eu tenho interesse em ajudar.`;
  }
}
