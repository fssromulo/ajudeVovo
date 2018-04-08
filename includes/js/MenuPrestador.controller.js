app.controller(
	"controllerMenu",
	function(
		$scope,
		$rootScope,
		$http
	){

	angular.element(document).ready(() => {
		$scope.__construct();	
	});

	$scope.__construct = () => {
		const clickFunction = () => {
			const modalAval = $('#modal_excluir_ajudante');
			modalAval.modal();	
			modalAval.modal('open');
		};

		$('#delete_forever_header').click(clickFunction);
		$('#delete_forever').click(clickFunction);
		
		$scope.podeExcluirContaRetorno = false;
		$scope.podeExcluirConta();
	};

	$scope.excluir = () => {
		$http.post(
			'../Pessoa/inativarPessoa'
		).success((data) => {
			$scope.fechar();
			location.href = "../home/";
		});
	};

	$scope.podeExcluirConta = () => {
		$http.post(
			'../ControlePrestador/obterSePodeExcluir'
		).success((data) => {
			$scope.podeExcluirContaRetorno = data[0].pode == "S";
		});
	};

	$scope.fechar = () => {
		$('#modal_excluir_ajudante').modal('close');
	}
});