app.controller(
	"controllerAvaliacao",
	function($scope, $rootScope, $http, RealizaAvaliacao) {


	$scope.__construct = function() {};

	$scope.salvarAvaliacao = function() {

		let arrAvaliacao = {
			'nota'  		 : $scope.nota | 0,
			'comentario'     : $scope.comentario,
			'id_servico'	 : RealizaAvaliacao.getIdServicoSolicitado()
		};


	    $http.post(
	    		'../avaliacao/salvar',
	    		arrAvaliacao
	    	).success(function (data) {

	    		if ( $scope.is_contratante == 1 ) {
	    			RealizaAvaliacao.atualizarEstadoService();	    		
	    		}

	    		$scope.arrAvaliacao = data;
	    		$scope.cancelar();
		});
	};

	$scope.cancelar = function () {
		$('#modalAvaliacao').modal('hide');
		$scope.nota = null;
		$scope.comentario = null;
	}

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});