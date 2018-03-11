var app =  angular.module(
	"appAngular",
 	[
         'angular-loading-bar'
 	]
);

app.controller("controllerListarServico", function($scope, $http) {

	$scope.__construct = function() {
		$scope.getServicos();	
	};

	$scope.getServicos = function() {
        $http
        	.post('../ListarServico/getServicos')
    		.success(function (data) {
            	$scope.arrListaServico = data;
        	});
    };

    $scope.carregarExcluir = function(servico) {
        $("#modal_excluir").modal();
        $("#modal_excluir").modal('open');
        $scope.id_servico = servico.id_servico;
    };

    $scope.excluirServico = function() {
        var arrServicoExcluir = {
            "id_servico" : $scope.id_servico
        }

        $http
        	.post('../ListarServico/excluir',arrServicoExcluir)
        	.success(function (data) {
            	$scope.arrListaServico = data;
        	});
    };

    // TO-DO: CARD NO TRELLO
    // $scope.desativarServico = function() {
    //     var arrServicoDesativar = {
    //         "id_servico" : $scope.id_servico,
    //         "ativo" : 0
    //     }

    //     http
    //         .post('../ListarServico/desativarServico', arrServicoDesativar)
    //         .success(function(data) {
    //             $scope.arrListaServico = data;
    //         });
    // }

    $scope.fecharModalExcluir = function() {
        $("#modal_excluir").modal();
        $("#modal_excluir").modal('close');
    };

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});