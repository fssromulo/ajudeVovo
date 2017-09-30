app.controller("ctrlCartaoCredito", function($scope, $rootScope,$http, PessoaCartao){

	$scope.__construct = function() {

		// Inicializa variaveis
		$scope.id_cartao = null;
		$scope.is_alterar = false;
	
		// Chama metodos que vão preencher algo em tela
		$scope.getCartaoCredito();
	};

	$scope.cancelar = function () {
		$scope.is_alterar = false;
		$scope.id_cartao = null;
		$scope.nome_titular = null;
		$scope.numero_cartao = null;
		$scope.data_validade = null;
		$('#modalCartaoCredito').modal('toggle');
	}

	$scope.carregarAlterar = function( cartao ) {
	
		$scope.is_alterar = true;
		$scope.id_cartao = cartao.id_cartao;
		$scope.numero_cartao = cartao.numero_cartao;
		$scope.nome_titular = cartao.nome_titular;
		$scope.data_validade = cartao.data_validade;
	}

	$scope.carregaExcluir = function( cartao ) {
		$scope.id_cartao = cartao.id_cartao;
	}

	$scope.excluir = function() {
		var arrCartaoExcluir = {
			"id_cartao" : $scope.id_cartao
		}


	    $http.post(
	    		'../CartaoCredito/excluir',
	    		arrCartaoExcluir
	    	).success(function (data) {
	    		$('#modal_excluir').modal('hide');
	    		$scope.arrCartao = data;
		});
	};

	$scope.getCartaoCredito = function() {
		$http.post(
			'../CartaoCredito/getCartaoCredito'
		).success(function (data) {
			console.log(data);
			$scope.arrCartao = data;
			$scope.cancelar();
		});

	}

	$scope.salvarCartao = function() {

		var arrCartaoSalvar	= {
			"nome_titular" : $scope.nome_titular,
			"numero_cartao" : $scope.numero_cartao,
			"dt_validade" : $scope.dt_validade,
			"is_alterar" : $scope.is_alterar
		}

		PessoaCartao.setCartao( arrCartaoSalvar );
	}

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});
