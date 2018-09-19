var myapp = angular.module('myapp', []);

myapp.controller('mainController',function($scope,$http){

  $scope.ferramenta = function (action){
    $http({
					method: 'POST',
					url: 'controller/controllerFerramentas.php',
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data:
					{
						action: action
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
