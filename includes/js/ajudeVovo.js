var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerAngular", function($scope, $http){

	$scope.__construct = function() {

		// Inicializa variaveis
		$scope.id_pessoa_fisica = null;
		$scope.is_alterar = false;

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

		// Chama metodos que vão preencher algo em tela
		$scope.getPessoasVovo();
	};

	$scope.cancelar = function () {
		$scope.is_alterar = false;
		$scope.id_pessoa_fisica = null;
		$scope.nome_pessoa = null;
		$scope.email = null;
		$scope.fone = null;
	}

	$scope.carregarAlterar = function( pessoa ) {
	
		$scope.is_alterar = true;
		$scope.id_pessoa_fisica = pessoa.id_pessoa_fisica;
		$scope.nome = pessoa.nome;
		$scope.cpf = pessoa.cpf;
		$scope.rg = pessoa.rg;
		$scope.sexoSelected = { "valor" : pessoa.sexo };
	}

	$scope.carregaExcluir = function( pessoa ) {
		$scope.id_pessoa_fisica = pessoa.id_pessoa_fisica;
	}

	$scope.excluir = function() {
		var arrPessoaExcluir = {
			"id_pessoa_fisica" : $scope.id_pessoa_fisica
		}


	    $http.post(
	    		'../AjudeVovo/excluir',
	    		arrPessoaExcluir
	    	).success(function (data) {
	    		$('#modal_excluir').modal('toggle');
	    		$scope.arrPessoas = data;
		});
	};

	$scope.getPessoasVovo = function() {
		$http.post(
			'../AjudeVovo/getPessoasVovo'
		).success(function (data) {
			console.log(data);
			$scope.arrPessoas = data;
			$scope.cancelar();
		});

	}

	$scope.salvarAula = function( pessoa ) {

		var arrPessoaSalvar	= {
			"nome" : $scope.nome,
			"cpf" : $scope.cpf,
			"rg" : $scope.rg,
			"dt_nascimento" : $scope.dt_nascimento,
			"sexo" : $scope.sexoSelected['valor'],
			"is_alterar" : $scope.is_alterar
		}


		if ( $scope.is_alterar == true ) {
			arrPessoaSalvar['id_pessoa_fisica'] = $scope.id_pessoa_fisica;
		}

		$http.post(
			'../AjudeVovo/salvar',
			arrPessoaSalvar
		).success(function (data) {
			console.log(data);
			$scope.arrPessoas = data;
			$scope.cancelar();
		});

	}

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});
