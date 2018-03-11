app.controller("ctrlPessoa", function($scope, $rootScope,$http, PessoaCartao){

	$scope.objPessoa = {
		nome : '',
		dt_nascimento : '',
		cpf : '',
		sexo : '',
		pais : 'pais',
		arrListaPais : '',
		estado : '',
		cidade : '',
		bairro : '',
		rua : '',
		nr_rua : '',
		complemento : '',
		fone_comercial : '',
		fone_residencial : '',
		celular : '',
		email : '',
		login : '',
		senha1 : '',
		senha2 : ''
	};

	$scope.__construct = function() {

		$(".dt_nascimento").mask("99/99/9999",  {placeholder:"_"});
		$("#cpf").mask("999.999.999-99",  {placeholder:"_"});
		$(".cls-mascara-fone").mask("(99)9999-9999?9",  {placeholder:"_"});
		$("#cep").mask("99.999-999",  {placeholder:"_"});

		var dt_nascimento = new Date();
		$scope.dt_nascimento = dt_nascimento;
		$scope.month = ['Janeiro', 'Fevereiro', 'Março', 'Abri', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
		$scope.monthShort = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
		$scope.weekdaysFull = ['Domingo', 'Segunda-Feita', 'Terça-Feita', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
		$scope.weekdaysLetter = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];
		$scope.disable = [false, 1, 7];
		$scope.today = 'Hoje';
		$scope.clear = 'Limpar';
		$scope.close = 'Fechar';
		$scope.selectMonths = true;
		$scope.selectYears = 100;

		$scope.arrListaPais = [];
		$scope.arrListaEstado = [];
		$scope.arrListaCidade = [];

		// Inicializa variaveis
		$scope.id_pessoa_fisica = null;
		$scope.is_alterar = false;
		// $scope.arrListaPais = [];

		// Define array com sexos para listagem
		$scope.arrListaSexo = 
		{
			sexoSelected : 'sexoSelected',
			options : [{
				'descricao' : 'Feminino',
				'valor' : 'F'
			},
			{
				'descricao' : 'Masculino',
				'valor' : 'M'
			}]
		};

		angular.element('.modal').modal();

	};

	$scope.getListaPais = function() {

	    $http.post(
	    		'../Gerais/Geral/getListaPais/'
	    	).success(function (data) {
	    		$scope.arrListaPais = data;

		});
	}

	$scope.getListaEstado = function() {

		if ( $scope.arrListaPais.pais == undefined || $scope.arrListaPais.pais.length < 1 ) {
			return false;
		}

		
		$scope.objPessoa.pais = $scope.arrListaPais.pais;


	    $http.post(
	    		'../Gerais/Geral/getListaEstado/',
	    		$scope.objPessoa.pais
	    	).success(function (data) {
	    		$scope.arrListaEstado = data;

		});
	}

	$scope.getListaCidade = function() {
		
		// if ( $scope.arrListaEstado.estado == undefined || $scope.arrListaEstado.estado.length < 1 ) {
		// 	return false;
		// }

		$scope.objPessoa.estado = $scope.arrListaEstado.estado;
		
	    $http.post(
	    		'../Gerais/Geral/getListaCidade/',
	    		$scope.objPessoa.estado
	    	).success(function (data) {
	    		$scope.arrListaCidade = data;
		});
	}

	$scope.comparaValores = function(valor1, valor2) {
		if ( valor1 == undefined || valor2 == undefined ) {
			return false;
		}

		if ( valor1.length < 1 || valor2.length  < 1 ) {
			return false;
		}

		return angular.equals(
			valor1.trim(),
			valor2.trim()
		);
	};


	$scope.validaSalvar = function() {

		// Se as senhas não são iguais, então aborta o envio do formulário
		if ( !$scope.comparaValores($scope.objPessoa.senha1, $scope.objPessoa.senha2) ) {
			$.notify('Senhas não são iguais');
			return false;
		}

		var sexo   = $scope.arrListaSexo.sexoSelected['valor'];
		var cidade = $scope.arrListaCidade.cidade['id_cidade'];

		var arrPessoaSalvar =
		{
			'is_alterar' : $scope.is_alterar,
			'arrPessoa'  : {
				'nome'   : $scope.objPessoa.nome,
				'cpf'    : $scope.objPessoa.cpf,
				'sexo' 	 : sexo,
				'login'  : $scope.objPessoa.login,
				'senha'  : $scope.objPessoa.senha1,
				'dt_nascimento' : $scope.objPessoa.dt_nascimento
			},
			'arrEndereco' : {
				'id_cidade'  : cidade,
				'bairro'  : $scope.objPessoa.bairro,
				'rua'     : $scope.objPessoa.rua,
				'numero'  : $scope.objPessoa.nr_rua,
				'cep'     : $scope.objPessoa.cep,
				'complemento' : $scope.objPessoa.complemento
			},
			'arrContatos' : [
				{
					'descricao'        : $scope.objPessoa.fone_residencial,
					'id_tipo_contato'  : 1
				},
				{
					'descricao'        : $scope.objPessoa.fone_comercial,
					'id_tipo_contato'  : 2
				},
				{
					'descricao'        : $scope.objPessoa.celular,
					'id_tipo_contato'  : 3
				},
				{
					'descricao'        : $scope.objPessoa.email,
					'id_tipo_contato'  : 4
				}
			],
		};


		console.log(arrPessoaSalvar);

		if (($scope.is_ajudante == 1) && ( ($scope.is_contratante == 0) ||
		  	($scope.is_contratante == undefined) ||
		  	($scope.is_contratante == null)
		))
		{
			arrPessoaSalvar['is_ajudante'] = true;
			PessoaCartao.setIsAjudante(true);

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


		angular.element('#modalCartaoCredito').modal('open');

		PessoaCartao.setArrPessoa(arrPessoaSalvar);			
		// if ($scope.is_ajudante != 1)  {
		// 	PessoaCartao.salvarPessoaCartao();
		// }
	};
 
    /* Chama a modal para cadastro do cartão para o vovo e para o ajudante */
	$scope.verificaAcao = function () {
		$scope.validaSalvar();
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


	// Chama metodos que vão preencher algo em tela
	$scope.getListaPais();

});
