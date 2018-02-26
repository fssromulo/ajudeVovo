 var app =  angular.module(
	"AppHome",
 	[
 		'angular-loading-bar',
 		'ui.materialize'
 	]
);

app.controller("controllerHome", function($scope, $http){

	$scope.__construct = function() {
		$scope.is_contratante = false;
		$scope.is_ajudante = false;

		$scope.usuario_logar = null;
		$scope.senha_logar = null;

		 	$('.button-collapse').sideNav({
		      menuWidth: 300, // Default is 300
		      edge: 'left', // Choose the horizontal origin
		      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
		      draggable: true, // Choose whether you can drag to open on touch screens,
		      onOpen: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is opened
		      onClose: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is closed
		    }
		  );


	}

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

	    		if ( data != 'true' ) {
	    			alert('Usuário não encontrado');
	    			return;
	    		}

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
