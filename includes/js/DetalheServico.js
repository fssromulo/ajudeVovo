app.controller(
    "controllerDetalheServico",
    function(
        $scope,
        $rootScope,
        $http,
        ServicoClienteDetalhe
    )
{
	$scope.__construct = function() {

        $scope.id_servico_escolhido = null;
        $scope.arrDadosParam = [];

        $('.datetimepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR"
        });

        $scope.carregaTelaSolicitacao();
	};

    $scope.$on('TesteMaroto', function(e) {  
        $scope.__construct();    
    });


    $scope.carregaTelaSolicitacao = function() {
        $scope.id_servico_escolhido = ServicoClienteDetalhe.getIdServico();
        
        if ( $scope.id_servico_escolhido != null || $scope.id_servico_escolhido != undefined ) { 
            $scope.carregarDetalheServico();
            $scope.carregarDiaHorarioDisponivel();  
        }
    }

    $scope.carregarDetalheServico = function() {

        $scope.arrDadosParam = {
            'id_servico' : $scope.id_servico_escolhido 
        };

        $http.post(
            '../DetalheServico/buscaServico',
            $scope.arrDadosParam
        ).success(function (data) {
            $scope.arrListaServico = data;
            
        });
    }

	$scope.carregarDiaHorarioDisponivel = function(){
		$http.post(
            '../DetalheServico/buscaDiaHorarioDisponivel',
            $scope.arrDadosParam
        ).success(function (data) {
            $scope.arrListaDiaHorario = data;
        });
    
	}

    $scope.verificaDataExiste = function(){
        var dia= $('#vlData').val();
        var arrData=dia.split("/");
        var objDate= new Date(arrData[2], arrData[0]-1, arrData[1]);
        var dia_escolhido_solicitacao = objDate.getDay()+1;

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

    $scope.formatarHorario = function(horario) {
        return (horario.getHours() + ":" + horario.getMinutes());
    };

    $scope.salvarServico = function() {

        // Varre a lista de datas para verifica se data selecionada existe
        if ($scope.verificaDataExiste() != true){
            alert("Data Inválida!");
            return false;
        }

        var arrServicoSalvar = {
            'id_servico' : 5,
            'id_contratante' : 2,
            'id_forma_pagamento' : 1,
            'id_estado_operacao' : 3,
            'horario_inicio': $scope.formatarHorario($scope.horario_inicio),
            'horario_fim': $scope.formatarHorario($scope.horario_fim),
            'dia_solicitacao': $scope.dia_solicitacao            
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