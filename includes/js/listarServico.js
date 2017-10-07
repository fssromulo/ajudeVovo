var app =  angular.module(
	"appAngular",
 	[
         'angular-loading-bar'
 	]
);

app.controller("controllerListarServico", function($scope, $http) {

	$scope.__construct = function() {
		$scope.getServicos();	
	};

	// $scope.getServicos = function() {
 //        $http.post(
 //            '../ListarServico/getServicos'
 //        ).success(function (data) {
 //            $scope.arrListaServico = data;
 //            $scope.cancelar();
 //        });
 //    };

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
}