function ferramenta(action) {
  alert(action);
}

$(document).ready(function () {
  // verificação de clique
  $("button").click(function () {

    if(!$(this).disabled){
      // Desabilita o botao
      $(this).prop('disabled', true);
    }
  });
});
