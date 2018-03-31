 var app =  angular.module(
    "appAngular",
    [
        'angular-loading-bar',
        'ui.materialize'
    ]
);

app.controller(
    "ctrlAdmSelecaoAjudante",
    function(
        $scope,
        $rootScope,
        $http
    )
{
	$scope.__construct = function() {
       

       
         $scope.carregarDetalheServico();
	};

    $scope.carregarDetalheServico = function() {

        $http.post(
            '../AdministracaoSelecaoAjudante/getBuscaPessoasInativas'
           
        ).success(function (data) {
            $scope.arrlistaPessoas = data;
            
        });
    }

    $scope.aceitar = (id_pessoa_fisica) => {
        $scope.id_pessoa_fisica = id_pessoa_fisica;
        $scope.atualizarEstado(1);
    };

    $scope.negar = (id_pessoa_fisica) => {
        $scope.id_pessoa_fisica = id_pessoa_fisica;
        $scope.atualizarEstado(2);
    };

    $scope.atualizarEstado = function(estado) {
       var arrDados = {
            'id_pessoa_fisica': $scope.id_pessoa_fisica,
            'id_estado_pessoa_fisica': estado
        };

        $http.post(
            '../AdministracaoSelecaoAjudante/atualizarEstado',
            arrDados
        ).success(() => {
           $scope.carregarDetalheServico();
        });

       
    };


	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});