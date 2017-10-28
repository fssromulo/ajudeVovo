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
        $scope.tokenCartaoVovo = null;
        $scope.arrDadosParam = [];
        $scope.iniciaSessaoPagSeguro();

        $('.date').datepicker({
            language: "pt-BR",
            autoclose: true,
            keyboardNavigation: false
        });

        $scope.carregaTelaSolicitacao();
	};

    $scope.$on('carregaDetalheServico', function(e) {  
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

    $scope.verificaDataExiste = function() {

        var dia = $('#vlData').val();
        var arrData = dia.split("/");
        var objDate = new Date(arrData[2], arrData[1]-1, arrData[0]);
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
            'id_servico' : $scope.id_servico_escolhido,
            'id_forma_pagamento' : 1,
            'id_estado_operacao' : 3,
            'horario_inicio': $scope.formatarHorario($scope.horario_inicio),
            'horario_fim': $scope.formatarHorario($scope.horario_fim),
            'dia_solicitacao': $scope.dia_solicitacao,
            'tokenCartaoVovo' :  $scope.tokenCartaoVovo 
        }

        $http.post(
            '../DetalheServico/salvarSolicitacao',
            arrServicoSalvar
        ).success(function(data) {
        	alert("Salvo com sucesso!");
        });
    };

    $scope.iniciaSessaoPagSeguro = function() {
        $http.post(
            '../PagSeguro/PagSeguro/getSessaoPagSeguroFromLibrary'
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
                    $scope.getDadosCartao();
                    //tratamento comum para todas chamadas
                    // console.log('getPaymentMethods --> complete');
                    // console.log(response);
                }
            });     
        });
    }

    $scope.getDadosCartao = function() {
        $http.post(
            '../PagSeguro/PagSeguro/getCartaoFromLibrary'
        ).success(function (arrDadosCartao) {
            var param = {
                cardNumber: arrDadosCartao['numero_cartao'],
                cvv:  arrDadosCartao['codigo_seguranca'],
                expirationMonth: arrDadosCartao['mes_cartao'],
                expirationYear: arrDadosCartao['ano_cartao'],
                success: function(response) {
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

	angular.element(document).ready(function () {
		$scope.__construct();	
	});
});