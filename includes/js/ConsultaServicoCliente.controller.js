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
				loadRating = () => {	
					$('.starbox').each(function() {
						const starbox = jQuery(this);
						starbox.starbox({
							average: starbox.attr('data-button-count') / 5,
							changeable: false,
						});
					});
				};
				(function() {
					var ev = new $.Event('style'),
						orig = $.fn.css;
					$.fn.css = function() {
						$(this).trigger(ev);
						return orig.apply(this, arguments);
					}
				})();
				
				$('.card-reveal').bind('style', function(e) {
					setTimeout(() => {
						//alert( $(this).attr('style'));
					},0, false);
					
					//loadRating();
				});

				loadRating();
			},0, false);
		}
	}
});