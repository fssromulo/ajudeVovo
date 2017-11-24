var app = angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.service(
	'RealizaAvaliacao',
	function($rootScope, $http, $q) {

		this.id_servico_solicitado = 0;

		this.iniciaComponenteAvaliacao= function() {
	        $(function(){        
	            $('.kv-fa-heart').rating({
	                theme: 'krajee-fa',
	                filledStar: '<i class="fa fa-heart"></i>',
	                emptyStar: '<i class="fa fa-heart-o"></i>',
	                clearButtonTitle: 'Limpar',
	                clearCaption: '',
	                starCaptions: {1: ' ', 2: ' ', 3: ' ', 4: ' ', 5: ' '},
	                //showClear: false, disabled: true,
	                starCaptionClasses: {1: 'text-info', 2: 'text-info', 3: 'text-info', 4: 'text-info', 5: 'text-info'}
	            });
	            
	            $('.kv-fa').rating({
	                theme: 'krajee-fa',
	                filledStar: '<i class="fa fa-star"></i>',
	                emptyStar: '<i class="fa fa-star-o"></i>',
	                clearButtonTitle: 'Limpar',
	                clearCaption: 'Não avaliado'
	            });
	        });
		}

		this.setIdServicoSolicitado = function( id_servico_solicitado ) {
			this.id_servico_solicitado = id_servico_solicitado;
		}

		this.salvarAvaliacaoService = function() {
			$rootScope.$broadcast('salvarAvaliacao');
		}

		this.atualizarEstadoService = function() {
			$rootScope.$broadcast('finalizar_servico');
		}

		/* Mostrar Modaaal */
		this.abrirModal = function() {
			$('.kv-fa-heart').rating('reset');
			$('#modalAvaliacao').modal('show');	
		}

		this.getIdServicoSolicitado = function() {
			return this.id_servico_solicitado;
		}
	}
);