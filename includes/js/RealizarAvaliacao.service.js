var app = angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.service(
	'RealizaAvaliacao',
	function($rootScope, $http, $q) {

		this.id_servico = 0;

		this.iniciaComponenteAvaliacao = function() {
			$(() => {
				$('.starbox').each(function() {
					var starbox = jQuery(this);
					starbox.starbox({
						average: 0,
						ghosting: true,
						autoUpdateAverage: true,
					});
				});
			});
		}

		this.setIdServicoSolicitado = function( id_servico ) {
			this.id_servico = id_servico;
		}

		this.salvarAvaliacaoService = function() {
			$rootScope.$broadcast('salvarAvaliacao');
		}

		this.atualizarEstadoService = function() {
			$rootScope.$broadcast('finalizar_servico');
		}

		/* Mostrar Modal */
		this.abrirModal = function() {
			this.iniciaComponenteAvaliacao();
			const modalAval = $('#modalAvaliacao');
			modalAval.modal();	
			modalAval.modal('open');	
		}

		this.getIdServicoSolicitado = function() {
			return this.id_servico;
		}

		this.setMetodoAtualizar = (metodoAtualizar) => {
			this.metodoAtualizar = metodoAtualizar;
		}

		this.atualizar = () => {
			this.metodoAtualizar && this.metodoAtualizar();
		}
	}
);