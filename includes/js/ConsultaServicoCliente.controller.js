app.controller(
	"controllerAngular",
	function(
		$scope,
		$rootScope,
		$http,
		ServicoClienteDetalhe
	)
{

	$scope.__construct = () => {
		$scope.getServicos();
	};

	$scope.goToDetail = (id_servico) => {
		ServicoClienteDetalhe.setIdServico(id_servico);

		
			const modalAval = $('#modalDetalheServico');
			modalAval.modal();	
			modalAval.modal('open');

		if ( ServicoClienteDetalhe.getIdServico() != null ) {		
			// $('#modalDetalheServico').modal('show');


		}
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
		scope.$evalAsync( () => {
			$(() => {
				// $('.materialboxed').materialbox();
				$('.starbox').each(function() {
					var starbox = jQuery(this);
					starbox.starbox({
						average: starbox.attr('data-button-count') / 5,
						changeable: false,
					});
				});
			});
		});
	}
});