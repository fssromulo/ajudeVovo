app.config(function(ngJcropConfigProvider){

	/* Configurações do componente de corte de imagens */ 
    ngJcropConfigProvider.setJcropConfig({
        bgColor: 'black',
        bgOpacity: .4,
        aspectRatio: 1,
        maxWidth: 300,
        maxHeight: 300
    });

    // Used to differ the upload example
    ngJcropConfigProvider.setJcropConfig('upload', {
        bgColor: 'black',
        bgOpacity: .4,
        aspectRatio: 1,
        maxWidth: 300,
        maxHeight: 300
    });

});

// function getImageSrc(src) {
//     // return window.isLocal ? '/demo/' + src : src;
// }

app.controller("ctrlPessoa", function($scope, $rootScope,$http,$timeout, PessoaCartao){

	$scope.objPessoa = {
		nome : '',
		dt_nascimento : null,
		dt_nascimento_mobile : null,
		cpf : '',
		sexo : '',
		pais : 'pais',
		arrListaPaisEndereco : '',
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
		senha2 : '',
		id_estado : '',
		id_cidade : '',
		nome_pai : '',
		nome_mae : '',
		imagem_frente_documento : '',
		imagem_verso_documento : ''
	};

	$scope.__construct = function() {

		$(".dt_nascimento").mask("99/99/9999",  {placeholder:"_"});
		$("#cpf").mask("999.999.999-99",  {placeholder:"_"});
		$(".cls-mascara-fone").mask("(99)9999-9999?9",  {placeholder:"_"});
		$("#cep").mask("99.999-999",  {placeholder:"_"});

		let dt_nascimento = new Date();
		$scope.dt_nascimento = dt_nascimento;
		$scope.month = ['Janeiro', 'Fevereiro', 'Março', 'Abri', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
		$scope.monthShort = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
		$scope.weekdaysFull = ['Domingo', 'Segunda-Feita', 'Terça-Feita', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
		$scope.weekdaysvarter = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];
		$scope.disable = [false, 1, 7];
		$scope.today = 'Hoje';
		$scope.clear = 'Limpar';
		$scope.close = 'Fechar';
		$scope.selectMonths = true;
		$scope.selectYears = 100;

		$scope.arrListaPaisEndereco = [];
		
		$scope.arrListaEstadoEndereco = [];
		$scope.arrListaCidadeEndereco = [];
		
		$scope.arrListaEstadoNascimento = [];
		$scope.arrListaCidadeNascimento = [];

		// Inicializa variaveis
		$scope.id_pessoa_fisica = null;
		$scope.is_alterar = false;

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
 		angular.element('ul.tabs').tabs();
	};

	$scope.getListaPais = function() {

	    $http.post(
	    		'../Gerais/Geral/getListaPais/'
	    	).success(function (data) {
	    		$scope.arrListaPaisEndereco = data;

		});
	}

	$scope.getListaEstadoEndereco = function( ) {

	    $http.post(
	    		'../Gerais/Geral/getListaEstado/'
	    	).success(function (data) {
	    		$scope.arrListaEstadoEndereco   = data;
			}
		);
	}

	$scope.getListaEstadoNascimento = function( ) {

	    $http.post(
	    		'../Gerais/Geral/getListaEstado/'
	    	).success(function (data) {
	    		$scope.arrListaEstadoNascimento = data;
			}
		);
	}

	$scope.getListaCidadeEndereco = function() {

		$scope.objPessoa.estado = $scope.arrListaEstadoEndereco.estado;
		
	    $http.post(
	    		'../Gerais/Geral/getListaCidade/',
	    		$scope.objPessoa.estado
	    	).success(function (data) {
	    		$scope.arrListaCidadeEndereco = data;
		});
	}

	$scope.getListaCidadeNascimento = function() {
		
		$scope.objPessoa.id_estado = $scope.arrListaEstadoNascimento.estado;
		
	    $http.post(
	    		'../Gerais/Geral/getListaCidade/',
	    		$scope.objPessoa.id_estado
	    	).success(function (data) {
	    		$scope.arrListaCidadeNascimento = data;
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

 		/* $scope.obj.selection valores [x, y, x2, y2, w, h]
        	Coordenadas do corte da foto!!                
        */
            
        let x = $scope.obj.selection[0];
        let y = $scope.obj.selection[1];
        let w = $scope.obj.selection[4];
        let h = $scope.obj.selection[5];

		// Se as senhas não são iguais, então aborta o envio do formulário
		if ( !$scope.comparaValores($scope.objPessoa.senha1, $scope.objPessoa.senha2) ) {
			$.notify('Senhas não são iguais');
			return false;
		}

		let sexo    = $scope.arrListaSexo.sexoSelected['valor'];
		let cidadeEndereco  = $scope.arrListaCidadeEndereco.cidade['id_cidade'];
		
		// codigos do estado e da cidade de nascimento
		let id_estado  = '';
		let id_cidade  = '';
		
		if ( $scope.is_ajudante ) {
			id_estado  = $scope.arrListaEstadoNascimento.estado['id_estado'];
			id_cidade  = $scope.arrListaCidadeNascimento.cidade['id_cidade'];		
		}

		let data_nascimento_salvar = $scope.objPessoa.dt_nascimento;	
		// Verifica se deve pegar a data do campo referente ao mobile ou do campo do referente ao site
		if ( $scope.objPessoa.dt_nascimento != null || 
			$scope.objPessoa.dt_nascimento == undefined ) { 			

			let objData = new Date($scope.objPessoa.dt_nascimento_mobile);

	        data_nascimento_salvar = 
	            objData.getDate() + "/" 
	            + (objData.getMonth() + 1) + "/"
	            + objData.getFullYear();
		}


		let arrPessoaSalvar =
		{
			'is_alterar' : $scope.is_alterar,
			'arrDadosImagem'  : {
				'urlFoto' : $scope.obj.src,
				'x' : x,
				'y' : y,
				'w' : w,
				'h' : h
			},
			'arrPessoa' : {
				'nome'      : $scope.objPessoa.nome,
				'cpf'       : $scope.objPessoa.cpf,
				'sexo' 	    : sexo,
				'login'     : $scope.objPessoa.login,
				'senha'     : $scope.objPessoa.senha1,
				'nome_mae'  : $scope.objPessoa.nome_mae,
				'nome_pai'  : $scope.objPessoa.nome_pai,
				'id_estado' : id_estado,
				'id_cidade' : id_cidade,
				'dt_nascimento' : data_nascimento_salvar
			},
			'arrEndereco' : {
				'id_cidade'  : cidadeEndereco,
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
	
	$scope.trocarAba = function(tab_selecionada) {
		$('ul.tabs').tabs('select_tab', tab_selecionada);
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
	$scope.getListaEstadoNascimento();
	$scope.getListaEstadoEndereco();
	$scope.obj  = {src:"", selection: [], thumbnail: false};

    // $scope.$watch(
    //   'arrListaCidadeNascimento',
    //   function(ds_novo, ds_velho) {
    //      $timeout(function(argument) {
  		// 	$('select').material_select();
    //      });
    //   }
    // );
});