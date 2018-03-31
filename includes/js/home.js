 let app =  angular.module(
	"AppHome",
 	[
 		'angular-loading-bar',
 		'ui.materialize'
 	]
);

app.controller("controllerHome", function($scope, $http){

	$scope.__construct = function() {
		$scope.perfil = null;

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

		// Define o perfil
		$scope.escolherPerfil();

		if ( $scope.perfil == undefined || $scope.perfil.length < 1 ) {
			alert('Atenção! Perfil não identificado!');
			return false;
		}

		let arrDadosLogin = {
			"usuario" : $scope.usuario_logar,
			"senha"   : $scope.senha_logar,
			"perfil"  : $scope.perfil
		};

	    $http.post(
	    		'../Login/fazerLogin/',
	    		arrDadosLogin
	    	).success(function (data) {

	    		if ( data != 'true' ) {	    	
	    			$.notify(data, "error");
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
	
	$scope.novoCadastro = function( ) {		
		// Define o perfil
		$scope.escolherPerfil();

		location.href = "../Pessoa/?" + $scope.perfil;
	}

	$scope.escolherPerfil = function( ) {

		$scope.perfil = null;

		if ( $scope.is_ajudante ) {
			$scope.perfil = 'ajudante';
			return;
		}

		if ( $scope.is_contratante ) {
			$scope.perfil = 'contratante';
			return;
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
            	let content = $("#popLoginPessoa").html();
            	let compiledContent = $compile(content)(scope);
            	let options = {
                	content: compiledContent,
                	html: true,
            	};
            elemento.popover(options);
    }
  }
})
