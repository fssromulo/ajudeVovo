 var app =  angular.module(
    "appAngular",
    [
        'angular-loading-bar',
        'ui.materialize'
    ]
);

app.controller("ctrlrAdmCadastroNecessidades", function($scope,$rootScope,$http) {
	
	angular.element(document).ready(function () {
		$scope.__construct();	
	});


	$scope.__construct = function() {

        $scope.id_necessidade_especial = null;
        $scope.is_alterar = false;
        $scope.arrListaNecessidadesEspeciais = [];

        $scope.necessidades_especiais();
    };

    $scope.necessidades_especiais = function() {
        $http.post(
            '../AdmCadastroNecessidades/necessidades_especiais'
        ).success(function (data) {
            $scope.arrNecessidadesEspeciais = data;
            $scope.cancelar;
        });
    };

    $scope.salvarNecessidade = function() {
        if ($scope.form_necessidade.$invalid) {
            return;
        }

        var arrNecessidadesSalvar = {
            'descricao' : $scope.descricao
            
        }        

        $http.post(
            '../AdmCadastroNecessidades/salvar',
            arrNecessidadesSalvar
        ).success(function (data) {
            $scope.arrNecessidadesEspeciais = data;
            $scope.cancelar();
        });
    };

    $scope.alterarNecessidade = function() {
        var arrNecessidadesAlterar = {
            'id_necessidade_especial' : $scope.id_necessidade_especial,
            'descricao' : $scope.descricao
        }

        $http.post(
            '../AdmCadastroNecessidades/alterar',
            arrNecessidadesAlterar
        ).success(function (data) {
            $scope.arrNecessidadesEspeciais = data;
            $scope.cancelar();
        });
    };

    $scope.excluirNecessidade = function() {
        var arrNecessidadesExcluir = {
            "id_necessidade_especial" : $scope.id_necessidade_especial
        }

        $http.post(
            '../AdmCadastroNecessidades/excluir',
            arrNecessidadesExcluir
        ).success(function (data) {
            $('#modal_excluir').modal('toggle');
            $scope.arrNecessidadesEspeciais = data;
        });
    }

    $scope.cancelar = function () {
        $scope.is_alterar = false;
        $scope.id_necessidade_especial = null;
        $scope.descricao = null;
        
    }

    $scope.carregarAlterar = function(necessidades_especiais) {
        $scope.is_alterar = true;
        $scope.id_necessidade_especial = necessidades_especiais.id_necessidade_especial;
        $scope.descricao = necessidades_especiais.descricao;
    };

    $scope.carregarExcluir = function(perfil) {
        $scope.id_necessidade_especial = necessidades_especiais.id_necessidade_especial;
    };

    angular.element(document).ready(function () {
		$scope.__construct();	
	});

});



