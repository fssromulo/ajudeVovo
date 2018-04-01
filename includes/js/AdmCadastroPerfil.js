 var app =  angular.module(
    "appAngular",
    [
        'angular-loading-bar',
        'ui.materialize'
    ]
);

app.controller("ctrlrAdmCadastroPerfil", function($scope,$rootScope,$http) {
	
	angular.element(document).ready(function () {
		$scope.__construct();	
	});


	$scope.__construct = function() {

        $scope.id_perfil = null;
        $scope.is_alterar = false;
        $scope.arrListaPerfil = [];

        $scope.perfil();
    };

    $scope.perfil = function() {
        $http.post(
            '../AdmCadastroPerfil/perfil'
        ).success(function (data) {
            $scope.arrPerfil = data;
            $scope.cancelar;
        });
    };

    $scope.salvarPerfil = function() {
        if ($scope.form_perfil.$invalid) {
            return;
        }

        var arrPerfilSalvar = {
            'descricao' : $scope.descricao
            
        }        

        $http.post(
            '../AdmCadastroPerfil/salvar',
            arrPerfilSalvar
        ).success(function (data) {
            $scope.arrPerfil = data;
            $scope.cancelar();
        });
    };

    $scope.alterarPerfil = function() {
        var arrPerfilAlterar = {
            'id_perfil' : $scope.id_perfil,
            'descricao' : $scope.descricao
        }

        $http.post(
            '../AdmCadastroPerfil/alterar',
            arrPerfilAlterar
        ).success(function (data) {
            $scope.arrPerfil = data;
            $scope.cancelar();
        });
    };

    $scope.excluirPerfil = function() {
        var arrPerfilExcluir = {
            "id_perfil" : $scope.id_perfil
        }

        $http.post(
            '../AdmCadastroPerfil/excluir',
            arrPerfilExcluir
        ).success(function (data) {
            $('#modal_excluir').modal('toggle');
            $scope.arrPerfil = data;
        });
    }

    $scope.cancelar = function () {
        $scope.is_alterar = false;
        $scope.id_perfil = null;
        $scope.descricao = null;
        
    }

    $scope.carregarAlterar = function(perfil) {
        $scope.is_alterar = true;
        $scope.id_perfil = perfil.id_perfil;
        $scope.descricao = perfil.descricao;
    };

    $scope.carregarExcluir = function(perfil) {
        $scope.id_perfil = perfil.id_perfil;
    };

    angular.element(document).ready(function () {
		$scope.__construct();	
	});

});



