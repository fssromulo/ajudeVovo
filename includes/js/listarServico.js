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

	$scope.getServicos = function() {
        $http
        	.post('../ListarServico/getServicos')
    		.success(function (data) {
            	$scope.arrListaServico = data;
        	});
    };

    $scope.carregarExcluir = function(servico) {
        $scope.id_servico = servico.id_servico;
    };

    $scope.excluirServico = function() {
        var arrServicoExcluir = {
            "id_servico" : $scope.id_servico
        }

        $http
        	.post('../ListarServico/excluir',arrServicoExcluir)
        	.success(function (data) {
            	$('#modal_excluir').modal('toggle');
            	$scope.arrListaServico = data;
        	});
    };

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});