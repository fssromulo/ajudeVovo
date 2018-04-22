var app = angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.service(
	'RealizaAvaliacao',
	function($rootScope, $http, $q) {

		this.usa = true;
		this.servico_solicitado = {};

		this.iniciaComponenteAvaliacao = function() {
			$(() => {
				$('.starbox').each(function() {
					let starbox = jQuery(this);
					starbox.starbox({
						average: 0,
						ghosting: true,
						autoUpdateAverage: true,
					});
				});
			});
		}

		this.setUsaServico = usa => {
			this.usa = usa;

			if (!usa) {
				this.servico_solicitado.id_servico = null;
			}
		}

		this.setServicoSolicitado = servico_solicitado => {
			this.servico_solicitado = servico_solicitado;
		}

		this.salvarAvaliacaoService = () => {
			$rootScope.$broadcast('salvarAvaliacao');
		}

		this.atualizarEstadoService = () => {
			$rootScope.$broadcast('finalizar_servico');
		}

		/* Mostrar Modal */
		this.abrirModal = () => {
			this.iniciaComponenteAvaliacao();
			const modalAval = $('#modalAvaliacao');
			modalAval.modal();	
			modalAval.modal('open');	
		}

		this.getServicoSolicitado = () => {
			return this.servico_solicitado;
		}

		this.setMetodoAtualizar = metodoAtualizar => {
			this.metodoAtualizar = metodoAtualizar;
		}

		this.atualizar = () => {
			this.metodoAtualizar && this.metodoAtualizar();
		}
	}
);