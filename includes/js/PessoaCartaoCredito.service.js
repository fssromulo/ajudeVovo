var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.service(
	'PessoaCartao',
	function($rootScope, $http, $q){
		this.arrCartao 	   = [];
		this.arrPessoa 	   = [];
		this.isAjudante    = false;
		this.isContratante = false;

		this.setIsContratante = function( isContratante ) {
			this.isContratante = isContratante;
		}

		this.setIsAjudante = function( isAjudante ) {
			this.isAjudante = isAjudante;
		}

		this.setCartao = function( arrCartaoPessoa ) {
			this.arrCartao = arrCartaoPessoa;
		}

		this.getCartao = function() {
			return this.arrCartao;
		}

		this.setArrPessoa = function( arrPessoa ) {
			this.arrPessoa = arrPessoa;
		}

		this.getArrPessoa = function() {
			return this.arrPessoa;
		}

		this.salvarPessoaCartao = function () {

			var arrDados = [];

			arrDados = this.getArrPessoa();

			if (
				(this.getCartao() != undefined) ||
				(this.getCartao() != null) ||
				(this.getCartao() != '')
			) {
				arrDados['cartaoCredito'] = this.getCartao();	
			}

		    $http.post(
		    		'../Pessoa/salvar',
		    		arrDados
		    	).success(function (retornoRequisicao) {
		    		
		    		// Se for ajudante, redireciona para cadastrar seus serviço
		    		if (retornoRequisicao == 'contratante')  {
		    			location.href = "../ListarServico/";
		    		}

					if (retornoRequisicao == 'ajudante') {
		    			location.href = "../ConsultaServicoCliente/"; 						
					}	    		
			});
		}
	}
);