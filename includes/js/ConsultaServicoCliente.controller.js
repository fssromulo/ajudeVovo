app.controller(
	'controllerAngular',
	function(
		$scope,
		$rootScope,
		$http,
		$timeout,
		ServicoClienteDetalhe
	){
	
	$scope.goToDetail = (id_servico) => {
		ServicoClienteDetalhe.setIdServico(id_servico);

		const modalAval = $('#modalDetalheServico');
		modalAval.modal();	
		modalAval.modal('open');
	}

	$scope.openFilter = () => {
		const modalFilter = $('#modalFilter');
		modalFilter.modal();	
		modalFilter.modal('open');
		loadHelperAutoComplete();
		
		if ($scope.firstActivation) {
			loadSliders();
			$scope.firstActivation = false;
		}

		$scope.openDlg = 'open';
	}

	$scope.openOrder = () => {
		const modalOrder = $('#modalOrder');
		modalOrder.modal();	
		modalOrder.modal('open');
		$scope.openDlg = 'open';
	}

	$scope.filtrar = () => {
		$('#modalFilter').modal('close');
		$scope.openDlg = 'close';

		$scope.filter.categoria = 
			$scope.arrCategorias.id_categoria ? 
				$scope.arrCategorias.id_categoria.id_categoria : 
					null;

		$scope.getServicos();
	}

	$scope.ordenar = () => {
		$('#modalOrder').modal('close');
		$scope.openDlg = 'close';
		$scope.getServicos();
	}

	$scope.limparItemFiltro = (item) => {
		switch (item) {
			case 'categoria':
				$scope.filter.categoria = null;
				break;
			case 'descricao':
				$scope.filter.descricao = '';
				break;
			case 'ajudante':
				$scope.filter.ajudante = '';
				break;
		}

		$scope.getServicos();
	}

	$scope.getServicos = () => {
		$http.post(
			'../ConsultaServicoCliente/getServicosCliente',
			[$scope.filter, $scope.order]
		).success((data) => {
			$scope.arrServicos = data;			
		});
	}

	$scope.$watch(
    	'openDlg',
    	() => {
        	$timeout(
				() => {
					$('select').material_select();
				}, 0
			);
     	}
   	);

	loadHelperAutoComplete = () => {
		$('#ajudante').autocomplete({
			data: $scope.arrAjudantes,
			limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
			onAutocomplete: (val) => {}, // Callback function when value is autcompleted.
			minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
		});
	}

	loadSliders = () => {
		loadSlider($('#valor')[0], 0, 100);
		loadSlider($('#estrelas')[0], 0, 5);
	}

	loadSlider = (slider, start, end) => {
		noUiSlider.create(slider, 
			{
				start: [start, end],
				connect: true,
				step: 1,
				orientation: 'horizontal', // 'horizontal' or 'vertical'
				range: {
					'min': start,
					'max': end
				},
				format: wNumb({
					decimals: 0
				})
			}
		);
	}

	getCategorias = () => {
		$http.post(
			'../Categoria/categorias'
		).success((data) => {
			$scope.arrCategorias = data;
		});
	}

	getAjudantes = () => {
		$http.post(
			'../ControlePrestador/getPrestadores' 
		).success((data) => {
			angular.forEach(data, (value, key) => {
				$scope.arrAjudantes[value.nome] = '../includes/imagens/fotos_pessoas/' + value.imagem_pessoa;
			});
		});
	}

	__construct = () => {
		$scope.order = 'qt_estrela desc';
		$scope.filter = {
			descricao: '', 
			ajudante: '',
			categoria: null,
		};

		$scope.arrAjudantes = {};
	
		$scope.orderOptions = [
			{ 
				model: 'qt_estrela desc',
				description: 'Estrelas'
			},
			{ 
				model: 'ds_categoria desc',
				description: 'Categorias'
			},
			{ 
				model: 'qt_servicos desc',
				description: 'Quantidade de serviços prestados'
			},
			{ 
				model: 'valor desc',
				description: 'Valor'
			}
		];

		$scope.firstActivation = true;

		$scope.getServicos();
		getCategorias();
		getAjudantes();
	};

	angular.element(document).ready(() => {
		__construct();	
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