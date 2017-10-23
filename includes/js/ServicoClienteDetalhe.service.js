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

		this.setIdServico = function( id_servico ) {
			if ( id_servico == null || id_servico == undefined || id_servico == '' ) {
				return;
			}

			this.id_servico = id_servico;
		}

		this.getIdServico = function( id_servico ) {
			return this.id_servico;
		}

	}
);