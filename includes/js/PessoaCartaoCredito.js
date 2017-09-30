var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.service(
	'PessoaCartao',
	function($rootScope, $http, $q){
		this.arrCartao= [];

		this.setCartao = function( arrCartaoPessoa ) {
			this.arrCartao = arrCartaoPessoa;

			console.log("dentro do servico Pessoa Cartao");
			console.log(this.arrCartao);
		}

		this.getCartao = function() {
			return this.cartao;
		}
	}
);


/**
	CONTROLLER DE CARTAO DE CREDITO
*/
/*
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
	    		$('#modal_excluir').modal('toggle');
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
			"data_validade" : $scope.data_validade,
			"is_alterar" : $scope.is_alterar
		}

		PessoaCartao.setCartao( $scope.numero_cartao );
		console.log(PessoaCartao.getCartao( $scope.numero_cartao ));
	
		if ( $scope.is_alterar == true ) {
			arrCartaoSalvar['id_cartao'] = $scope.id_cartao;
		}

		$http.post(
			'../CartaoCredito/salvar',
			arrCartaoSalvar
		).success(function (data) {
			console.log(data);
			$scope.arrCartao = data;
			$scope.cancelar();
		});

	}

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});

/**
 **	CONTROLLER DA PESSOA
*/

/*
app.controller("ctrlPessoa", function($scope, $rootScope,$http, PessoaCartao){

	$scope.__construct = function() {

		// Inicializa variaveis
		$scope.id_pessoa_fisica = null;
		$scope.is_alterar = false;
		$scope.arrListaPais = [];

		PessoaCartao.setCartao(666);

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


		console.log('GET --- SERVICO --- GET ---');
		console.log(PessoaCartao.getCartao());
		console.log('GET --- SERVICO --- GET ---');
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

	$scope.comparaValores = function(valor1, valor2) {
		return angular.equals(
			valor1.trim(),
			valor2.trim()
		);
	};

	$scope.salvar = function() {

		// Se as senhas não são iguais, então aborta o envio do formulário
		if ( !$scope.comparaValores($scope.senha1, $scope.senha2) ) {
			alert('Senhas não são iguais');
			return false;
		}

		var sexo   = $scope.sexoSelected['valor'];
		var pais   = $scope.paisSelected['id_pais'];
		var estado = $scope.estadoSelected['id_estado'];
		var cidade = $scope.cidadeSelected['id_cidade'];

		var arrPessoaSalvar =
		{
			'is_alterar' : $scope.is_alterar,
			'arrPessoa'  : {
				'nome'   : $scope.nome,
				'cpf'    : $scope.cpf,
				'sexo' 	 : sexo,
				'login'  : $scope.login,
				'senha'  : $scope.senha1,
				'dt_nascimento' : $scope.dt_nascimento
			},
			'arrEndereco' : {
				'id_cidade'  : cidade,
				'bairro'  : $scope.bairro,
				'rua'     : $scope.rua,
				'numero'  : $scope.nr_rua,
				'complemento' : $scope.complemento
			},
			'arrContatos' : [
				{
					'descricao'        : $scope.fone_residencial,
					'id_tipo_contato'  : 1
				},
				{
					'descricao'        : $scope.fone_comercial,
					'id_tipo_contato'  : 2
				},
				{
					'descricao'        : $scope.celular,
					'id_tipo_contato'  : 3
				},
				{
					'descricao'        : $scope.email,
					'id_tipo_contato'  : 4
				}
			],
		};

		if (($scope.is_ajudante == 1) && ( ($scope.is_contratante == 0) ||
		  	($scope.is_contratante == undefined) ||
		  	($scope.is_contratante == null)
		))
		{
			arrPessoaSalvar['is_ajudante'] = true;

		}
		else
		if (($scope.is_contratante == 1) && ( ($scope.is_ajudante == 0) ||
		  	($scope.is_ajudante == undefined) ||
		  	($scope.is_ajudante == null)
		))
		{
			arrPessoaSalvar['is_contratante'] = true;
		}
		else {
			return false;
		}


		if ( $scope.is_alterar == true ) {
			arrPessoaSalvar['id_pessoa_fisica'] = $scope.id_pessoa_fisica;
		}

	    $http.post(
	    		'../Pessoa/salvar',
	    		arrPessoaSalvar
	    	).success(function (data) {
	    		$scope.arrPessoas = data;
	    		$scope.cancelar();
		});
	};


	$scope.verificaAcao = function () {
	
		if ($scope.is_contratante == 1)  {
			$('#myModal').modal('show');
		}

		if ($scope.is_ajudante == 1) {
			$scope.salvar();
		}

	}

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

*/