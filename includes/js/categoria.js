var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerCategoria", function($scope, $http) {

    $scope.__construct = function() {

        $scope.cd_categoria = null;
        $scope.is_alterar = false;
        $scope.arrListaCategoria = [];
    };

    $scope.salvar = function() {

        console.log('Salvar');

        var descricao = $scope.descricao;

        var arrCategoriaSalvar = {
            'descricao' : $scope.descricao
        };

        console.log(arrCategoriaSalvar);

        return false;

        if ($scope.is_alterar == true) {
            arrCategoriaSalvar['cd_categoria'] = $scope.cd_categoria;
        }

        $http.post(
            '../categoria/salvar',
            arrCategoriaSalvar
        ).success(function (data) {
            $scope.arrCategoriaSalvar = data;
            $scope.cancelar();
        });
    };

    $scope.cancelar = function () {
        $scope.is_alterar = false;
        $scope.cd_categoria = null;
        $scope.descricao = null;
    }

    angular.element(document).ready(function () {
		$scope.__construct();	
	});
});