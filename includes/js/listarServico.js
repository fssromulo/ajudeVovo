var app =  angular.module(
	"appAngular",
 	[
         'angular-loading-bar'
 	]
);

app.controller("controllerListarServico", function($scope, $http) {

    $scope.__construct = function() {   
        $scope.getServicos();
        $scope.getCategorias();
    };

    $scope.getServicos = function() {
        $http.post(
            '../ListarServico/getServicos'
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.cancelar();
        });
    };

    $scope.getCategorias = function() {
        $http.post(
            '../ListarServico/getCategorias'
        ).success(function (data){
            $scope.arrListaCategoria = data;
            $scope.cancelar();
        });
    };

    $scope.carregarExcluir = function(servico) {
        $scope.id_servico = servico.id_servico;
    };

    angular.element(document).ready(function () {
		$scope.__construct();	
	});
});