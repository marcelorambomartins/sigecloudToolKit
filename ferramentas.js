var myapp = angular.module('myapp', []);

myapp.controller('mainController',function($scope,$http){
  var inputFile = {};
  inputFile.nameXML = '';
  inputFile.nameXLS = '';
  inputFile.nameDOC = '';


  $scope.ferramenta = function (action, inputFile){

    $http({
					method: 'POST',
					url: 'controller/controllerFerramentas.php',
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data:
					{
						action: action,
            xml: inputFile.nameXML,
            planilha: inputFile.nameXLS,
            word: inputFile.nameDOC
					}
					}).then(function successCallback(response) {
						console.log(response.data);
						$scope.dados = {result: response.data};
					}, function errorCallback(response) {
						console.log(response);
					});

  }

  $scope.validacao = function (action){

      if(action == "qtTotalProdutos"){
        var retorno = $scope.validaXML();
        if(retorno.erro){
          $scope.dados = retorno;
        }else{
          $scope.ferramenta(action, retorno.inputFile);
        }
      }else if(action == "insertNumeroNF" || action == "insertCodigoProduto" || action == "insertQuantProduto" || action == "insertInfoProduto"){
        var retornoXML = $scope.validaXML();
        var retornoXLS = $scope.validaXLS();
        if(retornoXML.erro){
          $scope.dados = retornoXML;
          console.log(retornoXML);
        }else if(retornoXLS.erro){
          $scope.dados = retornoXLS;
          console.log(retornoXLS);
        }else{
          console.log(retornoXML);
          //$scope.ferramenta(action, inputFile);
        }
      }else{
        //função DOC
      }


  }//fim da funcão

  $scope.validaXML = function (){
    retorno = "";

    if($('#inputXML')[0].files.length != 0){
      var caminho = "D:/Perfil/Usuario/Downloads/";
      inputFile.nameXML = caminho + $("#inputXML")[0].files[0].name;
      retorno = {inputFile};
    }else{
      retorno = {erro: "Você deve carregar um arquivo XML para usar essa função"};
    }

    return retorno;

  }//fim da funcão


  $scope.validaXLS = function (){
    retorno = "";

    if($('#inputXLS')[0].files.length != 0){
      var caminho = "D:/Perfil/Usuario/Downloads/";
      inputFile.nameXLS = caminho + $("#inputXLS")[0].files[0].name;
      retorno = inputFile;
    }else{
      retorno = {erro: "Você deve carregar um arquivo XLS para usar essa função"};
    }

    return retorno;
  }//fim da funcão


  $scope.validaDOC = function (){
    retorno = "";

    if($('#inputDOC')[0].files.length != 0){
      var caminho = "D:/Perfil/Usuario/Downloads/";
      inputFile.nameDOC = caminho + $("#inputDOC")[0].files[0].name;
      retorno = inputFile;
    }else{
      retorno = {erro: "Você deve carregar um arquivo DOC para usar essa função"};
    }

    return retorno;

  }//fim da funcão


  $(document).ready(function () {
    // verificação de clique
    //$("#result").hide(); // desabita result ao iniciar
    $("button").click(function () {
      if($scope.dados && !$scope.dados.erro){
        if(!$(this).disabled){
          // Desabilita o botao
          $(this).prop('disabled', true);
        }
      }

    });
  });

});// fim do controller
