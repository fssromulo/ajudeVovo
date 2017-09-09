var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerAngular", function($scope, $http){

	$scope.__construct = function() {
		$scope.getServicos();
	};

	$scope.getServicos = function() {
		$http.post(
			'../ConsultaServicoCliente/getServicosCliente'
		).success(function (data) {
			$scope.arrServicos = data;
		});
	}

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});
