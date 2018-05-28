app.controller(
	"controllerDetalheServico",
	function(
		$scope, $rootScope, $http, RealizaAvaliacao
	) {
    
    $scope.is_carregando_pagina = 1;

    $scope.__construct = function() {
        $scope.tokenCartaoVovo = null;
        
        RealizaAvaliacao.iniciaComponenteAvaliacao();
        $scope.carregarDetalheServico();
        $scope.iniciaSessaoPagSeguro();         
    };

    $scope.carregarDetalheServico = function(){
        $scope.is_carregando_pagina = 1;
		$http.post(
            '../ControleSolicitante/buscaServico'
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.is_carregando_pagina = 0;
        });
    };

	$scope.abrirTelaAvaliacao = (servico_solicitado) => {
        RealizaAvaliacao.setServicoSolicitado(servico_solicitado);
        RealizaAvaliacao.setMetodoAtualizar($scope.carregarDetalheServico);
		RealizaAvaliacao.abrirModal();
	};

    $scope.$on('finalizar_servico', function(e) {  
    	$scope.id_servico_solicitacao = RealizaAvaliacao.getServicoSolicitado().id_servico_solicitacao;
        $scope.atualizarEstado(6);  
    });

	$scope.atualizarEstado = (estado) => {
		var arrDados = {
			'id_servico_solicitacao': $scope.id_servico_solicitacao,
			'id_estado_operacao': estado
		};

		// Só envia o TOKEN caso esteja finalizando o SERVICO
		if (estado == 6) {
			arrDados['tokenCartaoVovo'] = $scope.tokenCartaoVovo;
		}

		$http.post(
			'../ControlePrestador/atualizarEstado',
			arrDados
        ).success(function (data) {
            $('#modalAvaliacao').modal('close');
            $scope.carregarDetalheServico();
            $.notify("Serviço finalizado!", "success");
        });
	}

    $scope.iniciaSessaoPagSeguro = function() {
        $http.post(
            '../PagSeguro/PagSeguro/getSessaoPagSeguroFromLibrary'
        ).success(function (data) {
            PagSeguroDirectPayment.setSessionId(data.trim());
            PagSeguroDirectPayment.getPaymentMethods({
                success: function(response) {
                    $scope.getDadosCartao();
                    // console.log('getPaymentMethods --> success');
                    // console.log(response);
                },
                error: function(response) {
                    // console.log('getPaymentMethods --> error');
                    // console.log(response);
                    //tratamento do erro
                },
                complete: function(response) {
                    //tratamento comum para todas chamadas
                    // console.log('getPaymentMethods --> complete');
                    // console.log(response);
                }
            });     
        });
    }               

    $scope.getDadosCartao = function() {
        $http.post(
            '../PagSeguro/PagSeguro/getCartaoFromLibrary'
        ).success(function (arrDadosCartao) {
            var param = {
                cardNumber: arrDadosCartao['numero_cartao'],
                cvv:  arrDadosCartao['codigo_seguranca'],
                expirationMonth: arrDadosCartao['mes_cartao'],
                expirationYear: arrDadosCartao['ano_cartao'],
                success: function(response) {
                    $scope.tokenCartaoVovo = response['card']['token'];                  
                },
                error: function(response) {
                    //tratamento do erro
                    // console.log('getPaymentMethods --> error');
                    // console.log(response);
                },
                complete: function(response) {
                    //tratamento comum para todas chamadas
                   // console.log('getPaymentMethods --> complete');
                    // console.log(response);
                }
            }

            PagSeguroDirectPayment.createCardToken(param);
        });
    }

    angular.element(document).ready(function () {
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
})
.directive('carregavovo', function(){
    return {
        restrict: 'EA',
        templateUrl: '../includes/js/componenteAjudeVovo/pre-loader-vovo.html',
        scope: {
           is_carregando_pagina: '=',            
        }
    };
});
