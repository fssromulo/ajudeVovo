var app =  angular.module(
	"appAngular",
	[]
);

app.controller("controllerAngular", function($scope, $http){

	$scope.cd_pessoa = null;
	$scope.is_alterar = false;

	$scope.listaPessoas = function(){
	    $http.post(
	    		'../teste/getPessoas'
	    	).success(function (data) {
	    		$scope.arrPessoas = data;
		});
	};

	$scope.salvar = function( pessoa ){

		var arrPessoaSalvar =
		{
			'nm_pessoa'  : $scope.nome_pessoa,
			'email'      : $scope.email,
			'fone'       : $scope.fone,
			'is_alterar' : $scope.is_alterar
		};

		if ( $scope.is_alterar == true ) {
			arrPessoaSalvar['cd_pessoa'] = $scope.cd_pessoa;
		}

	    $http.post(
	    		'../teste/salvar',
	    		arrPessoaSalvar
	    	).success(function (data) {
	    		// console.log(data);
	    		$scope.arrPessoas = data;
	    		$scope.cancelar();
		});
	};


	$scope.cancelar = function () {
		$scope.is_alterar = false;
		$scope.cd_pessoa = null;
		$scope.nome_pessoa = '';
		$scope.email = '';
		$scope.fone = '';
	}

	$scope.carregarAlterar = function( pessoa ) {
		$scope.is_alterar = true;

		$scope.cd_pessoa = pessoa.cd_pessoa;
		$scope.nome_pessoa = pessoa.nm_pessoa;
		$scope.email = pessoa.email;
		$scope.fone = pessoa.fone;
	}

	$scope.carregaExcluir = function( pessoa ) {
		$scope.cd_pessoa = pessoa.cd_pessoa;
	}

	$scope.excluir = function() {

	    $http.post(
	    		'../teste/excluir',
	    		$scope.cd_pessoa
	    	).success(function (data) {
	    		$('#modal_excluir').modal('hide');
	    		$scope.arrPessoas = data;
		});
	};
});