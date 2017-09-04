var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerServico", function($scope, $http) {

    $scope.__construct = function() {

        $scope.id_servico = null;
        $scope.id_categoria = null;
        $scope.id_prestador = null;
        $scope.is_alterar = false;

        $scope.getServicos();
        $scope.getCategorias();
        $scope.getPrestadores();
    };

    $scope.getServicos = function() {
        $http.post(
            '../Servico/getServicos'
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.cancelar();
        });
    };

    $scope.getCategorias = function() {
        $http.post(
            '../Servico/getCategorias'
        ).success(function (data){
            $scope.arrListaCategoria = data;
            $scope.cancelar();
        });
    }

    $scope.getPrestadores = function() {
        $http.post(
            '../Servico/getPrestadores'
        ).success(function (data) {
            $scope.arrListaPrestador = data;
            $scope.cancelar();
        });
    };

    $scope.salvarServico = function() {

        if ($scope.descricao) {

        }
        
        var arrServicoSalvar = {
            'descricao' : $scope.descricao,
            'valor' : $scope.valor,
            'id_categoria' : $scope.categoriaSelected['id_categoria'],
            'id_prestador' : $scope.prestadorSelected['id_prestador'],
        }

        $http.post(
            '../Servico/salvar',
            arrServicoSalvar
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.cancelar();
        });
    };

    $scope.alterarServico = function() {
        var arrServicoAtualizar = {
            'descricao' : $scope.descricao,
            'valor' : $scope.valor,
            'id_categoria' : $scope.categoriaSelected['id_categoria'],
            'id_prestador' : $scope.prestadorSelected['id_prestador']
        }

        $http.post(
            '../Servico/alterar',
            arrServicoAtualizar
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.cancelar();
        });

    }

    $scope.excluirServico = function() {
        var arrServicoExcluir = {
            "id_servico" : $scope.id_servico
        }

        $http.post(
            '../Servico/excluir',
            arrServicoExcluir
        ).success(function (data) {
            $('#modal_excluir').modal('toggle');
            $scope.arrListaServico = data;
        });
    };

    $scope.cancelar = function () {
        $scope.is_alterar = false;
        $scope.id_servico = null;
        $scope.descricao = null;
        $scope.valor = null;
        $scope.id_categoria = null;
        $scope.id_prestador = null;
    };

    $scope.carregarAlterar = function(servico) {
        $scope.is_alterar = true;
        $scope.servico = servico.id_servico;
        $scope.descricao = servico.descricao;
        $scope.valor = servico.valor;
        $scope.categoriaSelected = {"id_categoria" : servico.id_categoria  };
        $scope.prestadorSelected = {"id_prestador" : servico.id_prestador };
    };

    $scope.carregarExcluir = function(servico) {
        $scope.id_servico = servico.id_servico;
    };

    angular.element(document).ready(function () {
		$scope.__construct();	
	});
});