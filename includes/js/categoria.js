var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerCategoria", function($scope, $http) {

    $scope.__construct = function() {

        $scope.id_categoria = null;
        $scope.is_alterar = false;
        $scope.arrListaCategoria = [];

        $scope.getCategorias();
    };

    $scope.getCategorias = function() {
        $http.post(
            '../Categoria/getCategorias'
        ).success(function (data) {
            $scope.arrCategorias = data;
            $scope.cancelar;
        });
    };

    $scope.salvarCategoria = function() {
        var arrCategoriaSalvar = {
            'descricao' : $scope.descricao,
            'is_alterar' : $scope.is_alterar
        }

        if ($scope.is_alterar == true) {
            arrCategoriaSalvar['id_categoria'] = $scope.id_categoria;
        }

        $http.post(
            '../Categoria/salvar',
            arrCategoriaSalvar
        ).success(function (data) {
            $scope.arrCategorias = data;
            $scope.cancelar();
        });
    };

    $scope.excluirCategoria = function() {
        $http.post(
            '../Categoria/excluir',
            $scope.id_categoria
        ).success(function (data) {
            $('#modal_excluir').modal('toggle');
            $scope.arrCategorias = data;
        });
    }

    $scope.cancelar = function () {
        $scope.is_alterar = false;
        $scope.id_categoria = null;
        $scope.descricao = null;
    }

    $scope.carregarAlterar = function(categoria) {
        $scope.is_alterar = true;
        $scope.id_categoria = categoria.id_categoria;
        $scope.descricao = categoria.descricao;
    };

    $scope.carregarExcluir = function(categoria) {
        $scope.id_categoria = categoria.id_categoria;
    };

    angular.element(document).ready(function () {
		$scope.__construct();	
	});
});