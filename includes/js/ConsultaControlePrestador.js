app.controller(
	"controllerControlePrestador",
	function(
		$scope, $rootScope, $http, RealizaAvaliacao
	){

	$scope.__construct = () => {
    	RealizaAvaliacao.iniciaComponenteAvaliacao();
		$scope.carregarServicosSolicitados();
	};

	$scope.carregarServicosSolicitados = () => {
		$http.post(
			'../ControlePrestador/buscaServicos'
        ).success((data) => {
            $scope.arrListaServico = data;
        });
    };

	$scope.aceitar = (id_servico) => {
		$scope.id_servico = id_servico;
		$scope.atualizarEstado(1);
	};

	$scope.negar = (id_servico) => {
		$scope.id_servico = id_servico;
		$scope.atualizarEstado(2);
	};

	$scope.abrirTelaAvaliacao = (id_servico) => {
		RealizaAvaliacao.setIdServicoSolicitado(id_servico);
		RealizaAvaliacao.setMetodoAtualizar($scope.carregarServicosSolicitados);
		RealizaAvaliacao.abrirModal();
	};

    $scope.$on('finalizar_servico', function(e) {  
    	$scope.id_servico = RealizaAvaliacao.getIdServicoSolicitado();
        $scope.atualizarEstado(5);  
    });

	$scope.atualizarEstado = (estado) => {
		var arrDados = {
			'id_servico': $scope.id_servico,
			'id_estado_operacao': estado
		};

		$http.post(
			'../ControlePrestador/atualizarEstado',
			arrDados
        ).success(() => {
			const modalAval = $('#modalAvaliacao');
			modalAval.modal();
			modalAval.modal('close');
            $scope.carregarServicosSolicitados();
        });
	}	

	angular.element(document).ready(() => {
		$scope.__construct();	
	});
});
