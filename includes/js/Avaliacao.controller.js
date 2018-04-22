app.controller(
	"controllerAvaliacao",
	function($scope, $rootScope, $http, RealizaAvaliacao) {


	$scope.__construct = function() {};

	$scope.salvarAvaliacao = function() {
		$scope.nota = $('#nota').starbox("getValue") * 5 | 0;

		const servico_realizado = RealizaAvaliacao.getServicoSolicitado();

		let arrAvaliacao = {
			'nota'  		        : $scope.nota,
			'comentario'            : $scope.comentario,
			'id_servico'            : servico_realizado.id_servico,
			'id_servico_solicitado'	: servico_realizado.id_servico_solicitacao,
			'id_contratante'        : servico_realizado.id_contratante,
			'id_prestador'			: servico_realizado.id_prestador,
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