app.controller(
	"controllerAvaliacao",
	function($scope, $rootScope, $http, RealizaAvaliacao) {


	$scope.__construct = function() {};

	$scope.salvarAvaliacao = function() {
		$scope.nota = $('#nota').starbox("getValue") * 5 | 0;

		let arrAvaliacao = {
			'nota'  		 : $scope.nota,
			'comentario'     : $scope.comentario,
			'id_servico'	 : RealizaAvaliacao.getIdServicoSolicitado()
		};


	    $http.post(
	    		'../avaliacao/salvar',
	    		arrAvaliacao
	    	).success(function (data) {
	   			RealizaAvaliacao.atualizarEstadoService();	    		

	    		$scope.arrAvaliacao = data;
				$scope.cancelar();
				
				RealizaAvaliacao.atualizar();
		});
	};

	$scope.cancelar = function () {
		$('#modalAvaliacao').modal('close');
		$scope.nota = null;
		$scope.comentario = null;
	}

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});