app.controller(
	"controllerControlePrestador",
	function(
		$scope, $rootScope, $http, RealizaAvaliacao
	){

	$scope.is_carregando_pagina = 1;		

	$scope.__construct = () => {
    	RealizaAvaliacao.iniciaComponenteAvaliacao();
		$scope.carregarServicosSolicitados();
	};

	$scope.carregarServicosSolicitados = () => {
		$scope.is_carregando_pagina = 1;
		$http.post(
			'../ControlePrestador/buscaServicos'
        ).success((data) => {
        	$scope.is_carregando_pagina = 0;
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

	$scope.openServiceClick = (event) => {		
		loadRating = (element) => {	
			const starbox = $(element);
			starbox.starbox({
				average: starbox.attr('data-button-count') / 5,
				changeable: false,
			});
		};

		setTimeout(() => {
			const starbox = ($(event.currentTarget.parentElement).find('.starbox')[0]);

			setTimeout(() => {
				loadRating(starbox);
			}, 0, false);
		}, 0, false);
	}
});

app.directive('carregavovo', function(){
    return {
        restrict: 'EA',
        templateUrl: '../includes/js/componenteAjudeVovo/pre-loader-vovo.html',
        scope: {
           is_carregando_pagina: '=',            
        }
    };
});