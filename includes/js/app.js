var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerAngular", function($scope, $http){

	$scope.__construct = function() {

		// Inicializa variaveis
		$scope.cd_pessoa = null;
		$scope.is_alterar = false;
		$scope.arrListaPais = [];

		// Define array com sexos para listagem
		$scope.arrListaSexo = 
		[
			{
				'descricao' : 'Feminino',
				'valor' : 'F'
			},
			{
				'descricao' : 'Masculino',
				'valor' : 'M'
			}
		];


		$scope.sexoSelected = {		
			'descricao' : 'Masculino',
			'valor' : 'M'
		}		

		// Chama metodos que vão preencher algo em tela
		$scope.getListaPais();


	};

	$scope.getListaPais = function() {

	    $http.post(
	    		'../Gerais/Geral/getListaPais/'
	    	).success(function (data) {
	    		$scope.arrListaPais = data;
		});
	}

	$scope.getListaEstado = function() {

	    $http.post(
	    		'../Gerais/Geral/getListaEstado/',
	    		$scope.paisSelected
	    	).success(function (data) {
	    		$scope.arrListaEstado = data;
		});
	}

	$scope.getListaCidade = function() {

	    $http.post(
	    		'../Gerais/Geral/getListaCidade/',
	    		$scope.estadoSelected
	    	).success(function (data) {
	    		$scope.arrListaCidade = data;
		});
	}


	$scope.salvar = function() {

		var sexo   = $scope.sexoSelected['valor'];
		var pais   = $scope.paisSelected['id_pais'];
		var estado = $scope.estadoSelected['id_estado'];
		var cidade = $scope.cidadeSelected['id_cidade'];


		var arrPessoaSalvar =
		{
			'nome'  : $scope.nome,
			'dt_nascimento'      : $scope.dt_nascimento,
			'cpf'       : $scope.cpf,
			'rg' : $scope.rg,
			'sexo' : sexo,
			'pais' : pais,
			'estado' : estado,
			'cidade' : cidade,
			'bairro' : $scope.bairro,
			'rua' : $scope.rua,
			'numero' : $scope.numero,
			'complemento' : $scope.complemento,
			'fone_residencial' : $scope.fone_residencial,
			'fone_comercial' : $scope.fone_comercial,
			'celular' : $scope.celular,
			'email' : $scope.email,
			'login' : $scope.login,
			'senha' : $scope.senha1,
			'is_alterar' : $scope.is_alterar
		};

		console.log( arrPessoaSalvar );

		return false;

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
		$scope.nome_pessoa = null;
		$scope.email = null;
		$scope.fone = null;
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
	    		$scope.arrPessoas = data;
		});
	};


	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});
