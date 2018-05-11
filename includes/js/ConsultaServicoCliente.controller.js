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
			$scope.arrCategorias.selectedCategory && $scope.arrCategorias.selectedCategory.id_categoria ? 
				$scope.arrCategorias.selectedCategory.id_categoria : 
					null;

		$scope.filter.ajudante = $("#ajudante").val() || '';
		$scope.filter.descricao = $("#descricao_filtro").val() || '';

		$scope.filter.minEstrela = $("#minEstrela").val() || null;
		$scope.filter.maxEstrela = $("#maxEstrela").val() || null;

		$scope.filter.minValor = $("#minValor").val() || null;
		$scope.filter.maxValor = $("#maxValor").val() || null;

		$scope.getServicos();
	}

	$scope.ordenar = () => {
		$scope.modalFilterOrder.modal('close');
		$scope.openDlg = !$scope.openDlg;

		const field = $scope.orderFieldOptions.selectedFieldOrder ?
			$scope.orderFieldOptions.selectedFieldOrder.model : 'qt_estrela';
		const selOption = getSelectedOption("selectedOrder");
		const order =  selOption ? selOption : 'desc';

		$scope.order =  field + ' ' + order;
		$scope.getServicos();
	}

	getSelectedOption = (name) => {
		const context = getFieldByName(name);

		for (var i=0, n=context.toArray().length; i < n; i++) {
			const option = context[i];
			if (option.checked) {
				return option.value;
			}
		}
	}

	getFieldByName = (name) => {
		return $("[name="+name+"]");
	}

	setSelectedOption = (name, val) => {
		const context = getFieldByName(name);

		for (var i=0, n=context.toArray().length; i < n; i++) {
			const option = context[i];
			if (option.value == val) {
				option.checked = true;
			}
		}
	}

	$scope.limparItemFiltro = (item) => {
		switch (item) {
			case 'categoria':
				$scope.arrCategorias.selectedCategory = {};
				$scope.filter.categoria = null;
				break;
			case 'descricao':
				$scope.filter.descricao = '';
				$("#descricao_filtro").val(null);
				break;
			case 'ajudante':
				$scope.filter.ajudante = '';
				$("#ajudante").val(null);
				break;
			case 'valor':
				$scope.filter.minValor = null;
				$scope.filter.maxValor = null;
				$("#minValor").val(null);
				$("#maxValor").val(null);
				break;
			case 'estrela':
				$scope.filter.minEstrela = null;
				$scope.filter.maxEstrela = null;
				$("#minEstrela").val(null);
				$("#maxEstrela").val(null);
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

					const orderArr = $scope.order.split(' ');

					const changeValSelect = (selector, value) => {
						selector.val(value).closest('.select-wrapper').find('li').removeClass("active").closest('.select-wrapper').find('.select-dropdown').val(value).find('span:contains(' + value + ')').parent().addClass('selected active');
					}

					if (!$scope.orderFieldOptions.selectedFieldOrder) {
						changeValSelect($("#ordenacao"), "Estrelas");
					}
					setSelectedOption("selectedOrder", orderArr[1]);					
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
				model: 'qt_servico',
				description: 'Quantidade de serviços prestados'
			},
			{ 
				model: 'valor',
				description: 'Valor'
			}
		];
		
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