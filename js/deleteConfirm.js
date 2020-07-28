function verificaDelete(Id) {
  let id = Id;

  if (confirm('Deseja excluir este projeto? ')) {
    location.href = `delete.php?id=${id}`;
  }
}
