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

    $scope.carregarInativar = function(servico) {
        if ($scope.servicoPodeSerInativado(servico.id_servico)) {
            $("#modal_excluir").modal();
            $("#modal_excluir").modal('open');
            $scope.id_servico = servico.id_servico;
        } else {
            $.notify("Este serviço não pode ser excluído!", "error");
        }
    };

    $scope.servicoPodeSerInativado = function(id_servico) {
        $http
            .post('../ListarServico/servicoPodeSerInativado', id_servico)
            .success(function(data) {
                $scope.registrosEncontrados = data;
            });

        return $scope.registrosEncontrados == 0;
    }

    $scope.inativarServico = function() {
        $http
            .post('../ListarServico/inativarServico', $scope.id_servico)
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