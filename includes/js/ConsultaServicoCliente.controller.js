app.controller(
	'controllerAngular',
	function(
		$scope,
		$rootScope,
		$http,
		ServicoClienteDetalhe
	){
	
	$scope.goToDetail = (id_servico) => {
		ServicoClienteDetalhe.setIdServico(id_servico);

		const modalAval = $('#modalDetalheServico');
		modalAval.modal();	
		modalAval.modal('open');
	}

	$scope.openFilter = () => {
		$scope.isFilter = true;
		$scope.modalFilterOrder.modal();	
		$scope.modalFilterOrder.modal('open');
		loadHelperAutoComplete();
		
		if ($scope.firstActivation) {
			loadSliders();
			$scope.firstActivation = false;
		}

		$scope.openDlg = !$scope.openDlg;
	}

	$scope.openOrder = () => {
		$scope.isFilter = false;
		$scope.modalFilterOrder.modal();	
		$scope.modalFilterOrder.modal('open');
		$scope.openDlg = !$scope.openDlg;
	}

	$scope.filtrar = () => {
		$scope.modalFilterOrder.modal('close');
		$scope.openDlg = !$scope.openDlg;

		$scope.filter.categoria = 
			$scope.arrCategorias.selectedCategory ? 
				$scope.arrCategorias.selectedCategory.id_categoria : 
					null;

		$scope.filter.ajudante = $("#ajudante").val() || '';
		$scope.filter.descricao = $("#descricao").val() || '';

		const estrelas = $("#estrelas")[0].noUiSlider;
		$scope.filter.minEstrela = estrelas.get()[0];
		$scope.filter.maxEstrela = estrelas.get()[1];

		const valores = $("#valor")[0].noUiSlider;
		$scope.filter.minValor = valores.get()[0];
		$scope.filter.maxValor = valores.get()[1];

		$scope.getServicos();
	}

	$scope.ordenar = () => {
		$scope.modalFilterOrder.modal('close');
		$scope.openDlg = !$scope.openDlg;

		const field = $scope.orderFieldOptions.selectedFieldOrder ?
			$scope.orderFieldOptions.selectedFieldOrder.model : 'qt_estrela';
		const order =  $scope.orderOptions.selectedOrder ? 
			$scope.orderOptions.selectedOrder.model : 'desc';

		$scope.order =  field + ' ' + order;
		$scope.getServicos();
	}

	$scope.limparItemFiltro = (item) => {
		switch (item) {
			case 'categoria':
				$scope.arrCategorias.selectedCategory = {};
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
        	setTimeout(
				() => {
					$('select').material_select();
				}, 0
			);
     	}
   	);

	loadHelperAutoComplete = () => {
		setTimeout(() => {
			$('#ajudante').autocomplete({
				data: $scope.arrAjudantes,
				limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
				minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
			});
		}, 0);
	}

	loadSliders = () => {
		setTimeout(() => {
			loadSlider('valor', 0, 100);
			loadSlider('estrelas', 0, 5);
		}, 0);
	}

	loadSlider = (sliderName, start, end) => {
		const slider = $('#' + sliderName)[0];
		noUiSlider.create(slider, 
			{
				start: [start, end],
				connect: true,
				step: 1,
		//		tooltips: [ true, true ],
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
			minValor: null,
			maxValor: null,
			minEstrela: null,
			maxEstrela: null,
		};

		$scope.arrAjudantes = {};
	
		$scope.orderFieldOptions = [
			{ 
				model: 'qt_estrela',
				description: 'Estrelas'
			},
			{ 
				model: 'ds_categoria',
				description: 'Categorias'
			},
			{ 
				model: 'qt_servicos',
				description: 'Quantidade de serviços prestados'
			},
			{ 
				model: 'valor',
				description: 'Valor'
			}
		];

		$scope.orderOptions = [
			{ 
				model: 'desc',
				description: 'Maior para o menor'
			},
			{ 
				model: 'asc',
				description: 'Menor para o maior'
			},
		];

		$scope.firstActivation = true;

		$scope.modalFilterOrder = $('#modalFilterOrder');

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