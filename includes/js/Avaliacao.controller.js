var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerAvaliacao", function($scope, $http){

	$scope.__construct = function() {
	};

	$scope.salvar = function() {

		let arrAvaliacao =
		{
			'nota'  : $scope.nota | 0,
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
