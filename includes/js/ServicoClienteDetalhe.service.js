var app = angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.service(
	'ServicoClienteDetalhe',
	function($rootScope, $http, $q) {

		this.id_servico = null;
		this.sn_mostra_solicitacao = false;

		this.setIdServico = function( id_servico ) {
			this.sn_mostra_solicitacao = false;
			if ( id_servico == null || id_servico == undefined || id_servico == '' ) {
				return;
			}

			this.sn_mostra_solicitacao = true;
			this.id_servico = id_servico;

			$rootScope.$broadcast('carregaDetalheServico');
		}

		this.getIdServico = function( id_servico ) {
			return this.id_servico;
		}

		this.getMostrarSolicitacao = function() {
			return this.sn_mostra_solicitacao;
		}

	}
);