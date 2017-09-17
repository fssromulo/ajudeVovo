var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerAngular", function($scope, $http){

	$scope.__construct = () => {
		$scope.getServicos();
	};

	$scope.goToDetail = () => {
		$http.post(
			'../ConsultaServicoCliente/goToDetail'
		);
	}

	$scope.getServicos = function() {
		$http.post(
			'../ConsultaServicoCliente/getServicosCliente'
		).success(function (data) {
			$scope.arrServicos = data;
		});
	}

	angular.element(document).ready(() => {
		$scope.__construct();	
	});
});
