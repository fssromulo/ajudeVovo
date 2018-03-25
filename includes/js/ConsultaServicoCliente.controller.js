app.controller(
	"controllerAngular",
	function(
		$scope,
		$rootScope,
		$http,
		ServicoClienteDetalhe
	){

	$scope.__construct = () => {
		$scope.getServicos();
	};

	$scope.goToDetail = (id_servico) => {
		ServicoClienteDetalhe.setIdServico(id_servico);

		const modalAval = $('#modalDetalheServico');
		modalAval.modal();	
		modalAval.modal('open');
	}

	$scope.getServicos = function() {
		$http.post(
			'../ConsultaServicoCliente/getServicosCliente'
		).success(function (data) {
			$scope.arrServicos = data;			
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
				$('.materialboxed').materialbox();			
				
				loadRating = (element) => {	
					const starbox = $(element);
					starbox.starbox({
						average: starbox.attr('data-button-count') / 5,
						changeable: false,
					});
				};

				$('.starbox').each(function() {
					loadRating(this);
				});
				
				$('.activator').click((e) => {
					const starbox = ($(e.target.parentElement.parentElement).find('.starbox')[1]);
					setTimeout(() => {
						loadRating(starbox);
					}, 0, false);	
				});
			},0, false);
		}
	}
});