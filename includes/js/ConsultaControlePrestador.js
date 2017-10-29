var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerControlePrestador", function($scope, $http){

	$scope.__construct = () => {
		$scope.carregarServicosSolicitados();
	};

	$scope.carregarServicosSolicitados = () => {
		$http.post(
			'../ControlePrestador/buscaServicos'
        ).success((data) => {
            $scope.arrListaServico = data;
        });
    };

    angular.element(document).ready(() => {
		$scope.__construct();	
	});

	$scope.aceitar = (id_servico_solicitacao) => {
		$scope.id_servico_solicitacao = id_servico_solicitacao;
		$scope.atualizarEstado(1);
	};

	$scope.negar = (id_servico_solicitacao) => {
		$scope.id_servico_solicitacao = id_servico_solicitacao;
		$scope.atualizarEstado(2);
	};

	$scope.atualizarEstado = (estado) => {
		$http.post(
			'../ControlePrestador/atualizarEstado',
			{
				'id_servico_solicitacao': $scope.id_servico_solicitacao,
				'id_estado_operacao': estado
			}
        ).success(() => {
            $scope.carregarServicosSolicitados();
        });
	}	
});
