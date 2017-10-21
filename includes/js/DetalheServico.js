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

	
	$scope.carregarDetalheServico = function(){
		$http.post(
            '../DetalheServico/buscaServico'
        ).success(function (data) {
            $scope.arrListaServico = data;
            
        });
    
	}

	$scope.carregarDiaHorarioDisponivel = function(){
		$http.post(
            '../DetalheServico/buscaDiaHorarioDisponivel'
        ).success(function (data) {
            $scope.arrListaDiaHorario = data;
            console.log($scope.arrListaDiaHorario); 
        });
    
	}

    $scope.verificaDataExiste = function(){
        var dia= $('#vlData').val();
        var arrData=dia.split("/");
        var objDate= new Date(arrData[2], arrData[0]-1, arrData[1]);
        var dia_escolhido_solicitacao = objDate.getDay()+1;
        //console.log(dias[objDate.getDay()]);
        // console.log(arrData);

        // Variavel com retorno da funcao
        var retorno = false;

        // Laço "for" para varrer a lista de dias cadastrado no banco pra verificar se
        // a data que foi escolhida esta na lista
        for (var i = 0, len = $scope.arrListaDiaHorario.length; i < len; i++) {

            // Pega o numero dia do servico salvo no banco
            var dia_na_lista = $scope.arrListaDiaHorario[i]['nr_dia'];

            // verifica se o dia que a pessoa escolheu da solicitacao existe na lista 
            if (dia_na_lista == dia_escolhido_solicitacao ){
                retorno = true;
                break;
            }

        }

        return retorno;
    }

    $scope.salvarServico = function() {

        // Varre a lista de datas para verifica se data selecionada existe
        if ($scope.verificaDataExiste() != true){
            alert("Data Inválida!");
            return false;
        }

        var arrServicoSalvar = {
            'id_servico' : 5,
            'id_contratante' : 1,
            'id_forma_pagamento' : 1,
            'id_estado_operacao' : 3,
            'horario_inicio': $scope.horario_inicio,
            'horario_fim': $scope.horario_fim,
            'dia': $scope.dia
            
        }



        $http.post(
            '../DetalheServico/salvarSolicitacao',
            arrServicoSalvar
        ).success(function(data) {
        	alert("Salvo com sucesso!");
        });
    };

	

	angular.element(document).ready(function () {
		$scope.__construct();	
	});


});

