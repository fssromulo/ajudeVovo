app.controller("ctrlPessoa", function($scope, $rootScope,$http, PessoaCartao){

	$scope.__construct = function() {

		$("#dt_nascimento").mask("99/99/9999",  {placeholder:"_"});
		$("#cpf").mask("999.999.999-99",  {placeholder:"_"});
		$(".cls-mascara-fone").mask("(99)9999-99999",  {placeholder:"_"});

		// Inicializa variaveis
		$scope.id_pessoa_fisica = null;
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

	$scope.prepareToSalvar = function() {

		// Se as senhas não são iguais, então aborta o envio do formulário
		if ( !$scope.comparaValores($scope.senha1, $scope.senha2) ) {
			alert('Senhas não são iguais');
			return false;
		}

		var sexo   = $scope.sexoSelected['valor'];
		var pais   = $scope.paisSelected['id_pais'];
		var estado = $scope.estadoSelected['id_estado'];
		var cidade = $scope.cidadeSelected['id_cidade'];

		// var arrPessoaSalvar = { 
		// 	'arrCartao' : PessoaCartao.getCartao()
		// };

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
			PessoaCartao.isAjudante(true);

		}
		else
		if (($scope.is_contratante == 1) && ( ($scope.is_ajudante == 0) ||
		  	($scope.is_ajudante == undefined) ||
		  	($scope.is_ajudante == null)
		))
		{
			arrPessoaSalvar['is_contratante'] = true;
			PessoaCartao.setIsContratante(true);
		}
		else {
			return false;
		}

		if ( $scope.is_alterar == true ) {
			arrPessoaSalvar['id_pessoa_fisica'] = $scope.id_pessoa_fisica;
		}

		PessoaCartao.setArrPessoa(arrPessoaSalvar);			
		PessoaCartao.salvarPessoaCartao();


	 //    $http.post(
	 //    		'../Pessoa/salvar',
	 //    		arrPessoaSalvar
	 //    	).success(function (data) {
	 //    		$scope.cancelar();
	    		
	 //  	// if ($scope.is_contratante == 1) {
		// 		// 	$scope.salvar();
		// 		// }	    		
		// });
	};


	$scope.verificaAcao = function () {

		if ($scope.is_ajudante == 1)  {
			$('#modalCartaoCredito').modal('show');
		}

		$scope.prepareToSalvar();
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
