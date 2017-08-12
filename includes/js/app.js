var app =  angular.module(
	"appAngular",
	[]
);

app.controller("controllerAngular", function($scope, $http){

	$scope.listaPessoas = function(){
	    $http.post(
	    		'../teste/getPessoas'
	    	).success(function (data) {
	    		$scope.arrPessoas = data;
		});
	};

	$scope.criarPost = function(){

		var arrTeste =
		[
			{
				'nm_pessoa' : $scope.nome_pessoa,
				'email' : $scope.email,
				'fone' : $scope.fone
			}
		];

	    $http.post(
	    		'../teste/post',
	    		arrTeste
	    	).success(function (data) {
	    		console.log(data);
	    		$scope.arrPessoas = data;
		});
	};
});