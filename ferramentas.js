var myapp = angular.module('myapp', []);

myapp.controller('mainController',function($scope,$http){

  $scope.ferramenta = function (action){

    if($('#inputXML')[0].files.length != 0){
      var caminho = "D:/Perfil/Usuario/Downloads/";
      nameXML = caminho + $("#inputXML")[0].files[0].name;
    }else{
      nameXML = '';
    }

    if($('#inputXLS')[0].files.length != 0){
      var caminho = "D:/Perfil/Usuario/Downloads/";
      nameXLS = caminho + $("#inputXLS")[0].files[0].name;
    }else{
      nameXLS = '';
    }

    if($('#inputDOC')[0].files.length != 0){
      var caminho = "D:/Perfil/Usuario/Downloads/";
      nameDOC = caminho + $("#inputDOC")[0].files[0].name;
    }else{
      nameDOC = '';
    }

    /*
    var inputFile = [];

    inputFile.push($("#inputXML")[0].files[0].name);
    inputFile.push($("#inputXLS")[0].files[0].name);
    //inputFile.push($("#inputDOC")[0].files[0].name);


    var tam1 = $('#inputXML')[0].files.length;
    var tam2 = $('#inputXLS')[0].files.length;


    var nameXML = $("#inputXML")[0].files;
    var nameXLS = $("#inputXLS")[0].files[0].name;
    */

    $http({
					method: 'POST',
					url: 'controller/controllerFerramentas.php',
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data:
					{
						action: action,
            xml: nameXML,
            planilha: nameXLS,
            word: nameDOC
					}
					}).then(function successCallback(response) {
						console.log(response.data);
						$scope.dados = response.data;
					}, function errorCallback(response) {
						console.log(response);
					});

  }

});// fim do controller



$(document).ready(function () {
  // verificação de clique
  $("button").click(function () {

    if(!$(this).disabled){
      // Desabilita o botao
      $(this).prop('disabled', true);
    }
  });
});
