app.controller(
	"controllerControlePrestador",
	function(
		$scope, $rootScope, $http, RealizaAvaliacao
	){

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

	$scope.aceitar = (id_servico_solicitacao) => {
		$scope.id_servico_solicitacao = id_servico_solicitacao;
		$scope.atualizarEstado(1);
	};

	$scope.negar = (id_servico_solicitacao) => {
		$scope.id_servico_solicitacao = id_servico_solicitacao;
		$scope.atualizarEstado(2);
	};

	$scope.abrirTelaAvaliacao = (id_servico_solicitacao) => {
		RealizaAvaliacao.setIdServicoSolicitado(id_servico_solicitacao);
		RealizaAvaliacao.abrirModal();
	};

    $scope.$on('finalizar_servico', function(e) {  
    	$scope.id_servico_solicitacao = RealizaAvaliacao.getIdServicoSolicitado();
        $scope.atualizarEstado(5);  
    });

	$scope.atualizarEstado = (estado) => {
		$http.post(
			'../ControlePrestador/atualizarEstado',
			{
				'id_servico_solicitacao': $scope.id_servico_solicitacao,
				'id_estado_operacao': estado
			}
        ).success(() => {
        	$('#modalAvaliacao').modal('hide');
            $scope.carregarServicosSolicitados();
        });
	}	

	angular.element(document).ready(() => {
		$scope.__construct();	
	});
});
