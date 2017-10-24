var app =  angular.module(
	"appAngular2",
 	[]
);

app.controller("controllerAngular2", function($scope, $http){

	$scope.__construct = function() {
		$scope.tokenCartaoVovo = '';
		$scope.iniciaSessaoPagSeguro();
	};

	$scope.iniciaSessaoPagSeguro = function() {
		$http.post(
			'../PagSeguro/PagSeguro/getSessaoPagSeguro'
		).success(function (data) {
			// console.log(data);
			PagSeguroDirectPayment.setSessionId(data);
			PagSeguroDirectPayment.getPaymentMethods({
				success: function(response) {
					// console.log('getPaymentMethods --> success');
					// console.log(response);
				},
				error: function(response) {
					// console.log('getPaymentMethods --> error');
					// console.log(response);
					//tratamento do erro
				},
				complete: function(response) {
					//tratamento comum para todas chamadas
					// console.log('getPaymentMethods --> complete');
					// console.log(response);
				}
			});
			
			var param = {
				cardNumber: '4111111111111111',
				cvv: '123',
				expirationMonth: '12',
				expirationYear: '2030',
				success: function(response) {
				    //token gerado, esse deve ser usado na chamada da API do Checkout Transparente
				    // console.log('getPaymentMethods --> success');
					console.log(response);
					$scope.tokenCartaoVovo = response['card']['token'];
				},
				error: function(response) {
				    //tratamento do erro
				 				    // console.log('getPaymentMethods --> error');
					// console.log(response);
				},
				complete: function(response) {
				    //tratamento comum para todas chamadas
				   // console.log('getPaymentMethods --> complete');
					// console.log(response);
				}
			}

			PagSeguroDirectPayment.createCardToken(param);

		});

	}

	$scope.realizaPagamentoPagSeguro = function() {

		alert($scope.tokenCartaoVovo  );

		var arrDados = {
			'tokenDoCartao' : $scope.tokenCartaoVovo
		}

		$http.post(
			'../PagSeguro/PagSeguro/realizaPagamentoPagSeguro',
			arrDados
		).success(function (data) {
			// console.log(data);
		});

	}

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});
