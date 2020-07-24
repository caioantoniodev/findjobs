// Garante somente letras
// https://cursos.alura.com.br/forum/topico-permitir-apenas-letras-no-input-77192
function ApenasLetras(e, t) {
  try {
      if (window.event) {
          var charCode = window.event.keyCode;
      } else if (e) {
          var charCode = e.which;
      } else {
          return true;
      }
      // Segui a tabela https://adrianorosa.com/blog/jquery/jquery-keycode-tabela-de-referencia.html
      if (
          (charCode == 32) || // Espaços em branco
          (charCode >= 65 && charCode < 91) || // Letras Maiusculas
          (charCode >= 97 && charCode < 123) || // Letras Minusculas
          (charCode >= 192 && charCode < 255) // Acentuação
      ){
          return true;
      } else {
          return false;
      }
  } catch (err) {
      alert(err.Description);
  }
}

function ValidaEmail () {
  try {
      if (window.event) {
          var charCode = window.event.keyCode;
      } else if (e) {
          var charCode = e.which;
      } else {
          return true;
      }
      // Segui a tabela https://adrianorosa.com/blog/jquery/jquery-keycode-tabela-de-referencia.html
      if (
          (charCode == 46) || // Letras minusculas
          (charCode == 64) || // @
          (charCode == 95) ||  // Underscore
          (charCode >= 97 && charCode <= 122) // Letras minusculas
      ){
          return true;
      } else {
          return false;
      }
  } catch (err) {
      alert(err.Description);
  }
}