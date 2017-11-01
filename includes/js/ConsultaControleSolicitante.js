var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerDetalheServico", function($scope, $http){

	$scope.__construct = function() {
		$scope.carregarDetalheServico();
		
	};

	$scope.carregarDetalheServico = function(){
		$http.post(
            '../ControleSolicitante/buscaServico'
        ).success(function (data) {
            $scope.arrListaServico = data;
        });
    };

    angular.element(document).ready(function () {
		$scope.__construct();	
	});

});
