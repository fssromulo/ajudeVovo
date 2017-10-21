var app =  angular.module(
	"appAngular",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerDetalheServico", function($scope, $http){

	$scope.__construct = function() {
        $('.datetimepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR"
        });

		$scope.carregarDetalheServico();
		$scope.carregarDiaHorarioDisponivel();
	};

	
	$scope.carregarDiaHorarioDisponivel = function(){
		$http.post(
            '../DetalheServico/buscaDiaHorarioDisponivel'
        ).success(function (data) {
            $scope.arrListaDiaHorario = data;
            console.log($scope.arrListaDiaHorario); 
        });
    
	}
