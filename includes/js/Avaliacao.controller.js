var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerAvaliacao", function($scope, $http){

	$scope.__construct = function() {

		// Inicializa variaveis
		/*$scope.cd_pessoa = null;
		$scope.is_alterar = false;
		$scope.arrListaPais = [];

		// Chama metodos que vão preencher algo em tela
		$scope.getListaPais();
*/

	};



	$scope.salvar = function() {

		let arrAvaliacao =
		{
			'nota'  : $scope.nota,
			'comentario'  : $scope.comentario,
			'id_contratante'      : $scope.contratante,
			'id_servico'	: $scope.servico
		};

	    $http.post(
	    		'../avaliacao/salvar',
	    		arrAvaliacao
	    	).success(function (data) {
	    		$scope.arrAvaliacao = data;
	    		$scope.cancelar();
		});
	};

	$scope.cancelar = function () {
		$scope.nota = null;
		$scope.comentario = null;
	}

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});
