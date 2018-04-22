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

	$scope.aceitarServico = (id_servico_solicitacao) => {
		$scope.id_servico_solicitacao = id_servico_solicitacao;
		$scope.atualizarEstado(1);
	};

	$scope.negarServico = (id_servico_solicitacao) => {
		$scope.id_servico_solicitacao = id_servico_solicitacao;
		$scope.atualizarEstado(2);
	};

	$scope.abrirTelaAvaliacao = (servico_solicitado) => {
		RealizaAvaliacao.setServicoSolicitado(servico_solicitado);
		RealizaAvaliacao.setUsaServico(false);
		RealizaAvaliacao.setMetodoAtualizar($scope.carregarServicosSolicitados);
		RealizaAvaliacao.abrirModal();
	};

    $scope.$on('finalizar_servico', function(e) {  
    	$scope.id_servico_solicitacao = RealizaAvaliacao.getServicoSolicitado().id_servico_solicitacao;
        $scope.atualizarEstado(5);  
    });

	$scope.atualizarEstado = (estado) => {
		let arrDados = {
			'id_servico_solicitacao': $scope.id_servico_solicitacao,
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

app.directive('afterLoadServicesDirective', () => {
	return (scope, element, attrs) => {
		if (scope.$last) {
			setTimeout(() => {				
				loadRating = (element) => {	
					const starbox = $(element);
					starbox.starbox({
						average: starbox.attr('data-button-count') / 5,
						changeable: false,
					});
				};

				$('.collapsible-header').click((e) => {
					const starbox = ($(e.target.parentElement.parentElement).find('.starbox')[0]);
					setTimeout(() => {
						loadRating(starbox);
					}, 0, false);	
				});
			}, 0);
		}
	};
});