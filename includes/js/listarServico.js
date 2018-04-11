var app = angular.module(
    "appAngular",
    [
        'angular-loading-bar',
        'ui.materialize'
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

    $scope.carregarInativar = function(servico) {
        var registrosEncontrados = 0;
        $http
            .post('../ListarServico/servicoPodeSerInativado', servico.id_servico)
            .success(function(data) {
                registrosEncontrados = data;
            });

        if (registrosEncontrados == 0) {
            $("#modal_excluir_servico").modal();
            $("#modal_excluir_servico").modal('open');
            $scope.id_servico = servico.id_servico;
        } else {
            $.notify("Este serviço não pode ser excluído!", "error");
        }
    };

    $scope.inativarServico = function() {
        $http
            .post('../ListarServico/inativarServico', $scope.id_servico)
            .success(function(data) {
                $scope.arrListaServico = data;
            });

        $scope.fecharModalExcluir();
    };

    $scope.fecharModalExcluir = function() {
        $("#modal_excluir_servico").modal();
        $("#modal_excluir_servico").modal('close');
    };

    $scope.editarServico = function(servico) {
        location.href = '../Servico/?id_servico=' + servico.id_servico;
    };

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});