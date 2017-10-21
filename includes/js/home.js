 var app =  angular.module(
	"AppHome",
 	[
 		'angular-loading-bar'
 	]
);

app.controller("controllerHome", function($scope, $http){

	$scope.__construct = function() {
		$scope.is_contratante = false;
		$scope.is_ajudante = false;

		$("[data-toggle=popover]").popover({
		    html: true, 
			content: function() {
				$('[data-toggle="popover"]').popover('hide');
		          return $('#popLoginPessoa').html();
		    }
		});
	};

	$scope.fazerLogin = function() {

		var arrDadosLogin = {
			"usuario" : $scope.usuario_logar,
			"senha"   : $scope.senha_logar,
			"perfil"  : $scope.perfil
		};

	    $http.post(
	    		'../Login/fazerLogin/',
	    		arrDadosLogin
	    	).success(function (data) {
	    		if ( data == 'true' && arrDadosLogin['perfil'] == 'ajudante') {
	    			location.href = "../ListarServico/";
	    		}
	    		
	    		if ( data == 'true' && arrDadosLogin['perfil'] == 'contratante') {
	    			location.href = "../ConsultaServicoCliente/";
	    		}
		});				

	};

	$scope.cancelar = function() {
		$('[data-toggle="popover"]').popover('hide');
	};

	$scope.escolherPerfil = function( perfil ) {
		$scope.link_cadastro = '#';
		$scope.perfil = perfil.trim();

		if (
			($scope.perfil != 'ajudante') && ($scope.perfil != 'contratante') ||
			($scope.perfil == undefined) &&  ($scope.perfil == null) 
		)	
		{ 
			return false;
		}

		$scope.link_cadastro = '../Pessoa/';

		if ( $scope.perfil == 'ajudante' ) { 
			$scope.link_cadastro += '?' + $scope.perfil; 
		}

		if ( $scope.perfil == 'contratante' ) { 
			$scope.link_cadastro += '?' + $scope.perfil;
		}
	}


	angular.element(document).ready(function () {
		$scope.__construct();	
	});
}).directive(
	'popover',
	function($compile, $timeout) {
    	return {
    		restrict: 'A',
    		link:function(scope, elemento, attrs){
            	var content = $("#popLoginPessoa").html();
            	var compiledContent = $compile(content)(scope);
            	var options = {
                	content: compiledContent,
                	html: true,
            	};
            elemento.popover(options);
    }
  }
})
