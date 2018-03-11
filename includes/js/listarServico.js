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
        $("#modal_excluir").modal();
        $("#modal_excluir").modal('open');
        $scope.id_servico = servico.id_servico;
    };

    $scope.desabilitarServico = function() {
        $http
            .post('../ListarServico/desabilitarServico', $scope.id_servico)
            .success(function(data) {
                $scope.arrListaServico = data;
            });

        $scope.fecharModalExcluir();
    }

    $scope.fecharModalExcluir = function() {
        $("#modal_excluir").modal();
        $("#modal_excluir").modal('close');
    };

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});