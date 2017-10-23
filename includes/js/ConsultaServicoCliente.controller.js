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

		if ( ServicoClienteDetalhe.getIdServico() != null ) {		
			$('#modalDetalheServico').modal('show');	
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

app.directive('afterLoadServicesDirective', function() {
	return function(scope, element, attrs) {
		if (scope.$last) {
			const classes = [];
			const captions = [];
			for (var index = 0; index < 50; index++) {
				classes[index/10] = 'text-info';
				captions[index/10] = ' ';
			}

			scope.$evalAsync( () => {
				$('.kv-fa-heart').rating({
					theme: 'krajee-fa',
					filledStar: '<i class="fa fa-heart"></i>',
					emptyStar: '<i class="fa fa-heart-o"></i>',
					clearCaption: '',
					starCaptions: captions,
					disabled: true, 
					showClear: false,
					starCaptionClasses: classes
				});
			});
		}
	}
});