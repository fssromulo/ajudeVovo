app.controller(
	"controllerDetalheServico",
	function(
		$scope, $rootScope, $http, RealizaAvaliacao
	) {

	$scope.__construct = function() {
		RealizaAvaliacao.iniciaComponenteAvaliacao();
		$scope.carregarDetalheServico();
		
	};

	$scope.carregarDetalheServico = function(){
		$http.post(
            '../ControleSolicitante/buscaServico'
        ).success(function (data) {
            $scope.arrListaServico = data;
        });
    };

	$scope.abrirTelaAvaliacao = (id_servico_solicitacao) => {
		RealizaAvaliacao.setIdServicoSolicitado(id_servico_solicitacao);
		RealizaAvaliacao.abrirModal();
	};

    $scope.$on('finalizar_servico', function(e) {  
    	$scope.id_servico_solicitacao = RealizaAvaliacao.getIdServicoSolicitado();
        $scope.atualizarEstado(6);  
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
            $scope.carregarDetalheServico();
        });
	}

    angular.element(document).ready(function () {
		$scope.__construct();	
	});

});
