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


	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});