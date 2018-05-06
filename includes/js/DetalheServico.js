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
        $scope.bloquear_btn_servico = false;
        $scope.arrDadosParam = [];

        // $scope.carregaTelaSolicitacao();
	};

    $scope.$on('carregaDetalheServico', function(e) {  
        $scope.carregaTelaSolicitacao();   
    });

    $scope.carregaTelaSolicitacao = function() {
        $scope.id_servico_escolhido = ServicoClienteDetalhe.getIdServico();
        
        if ( $scope.id_servico_escolhido != null || $scope.id_servico_escolhido != undefined ) {
            // $scope.iniciaSessaoPagSeguro(); 
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

    validarDiaHorario = () => {
        const dia = $('#vlData').val();
        const arrData = dia.split("-");
        const objDate = new Date(arrData[0], arrData[1]-1, arrData[2]);
        const dia_escolhido_solicitacao = objDate.getDay()+1;
        let retorno = {};

        // Laço "for" para varrer a lista de dias cadastrado no banco pra verificar se
        // a data que foi escolhida esta na lista
        for (var i = 0, len = $scope.arrListaDiaHorario.length; i < len; i++) {

            // Pega o numero dia do servico salvo no banco
            const dia_na_lista = $scope.arrListaDiaHorario[i];

            // verifica se o dia que a pessoa escolheu da solicitacao existe na lista 
            if (dia_na_lista['nr_dia'] == dia_escolhido_solicitacao ){
                const addTime = (dateObj, dateStr) => {
                    const copy = new Date();
                    const arrDate = dateStr.split(":");
                    
                    copy.setTime(dateObj.getTime());
                    copy.setHours(arrDate[0]);
                    copy.setMinutes(arrDate[1]);

                    return copy; 
                }

                const inputedTimeStart = addTime(objDate, $("#horario_inicio").val());
                const inputedTimeEnd = addTime(objDate, $("#horario_fim").val());
                const serviceTimeStart = addTime(objDate, dia_na_lista.horario_inicio);
                const serviceTimeEnd = addTime(objDate, dia_na_lista.horario_fim);

                if ((inputedTimeStart < serviceTimeStart || inputedTimeStart > serviceTimeEnd) || 
                    (inputedTimeEnd > serviceTimeEnd || inputedTimeEnd < serviceTimeStart) || 
                    (inputedTimeEnd < inputedTimeStart)) {
                    retorno = {horario: {}};
                } else {
                    retorno = undefined;
                    break;
                }
            }
        }
        return retorno;
    }

    $scope.formatarHorario = function(horario) {
        return (horario.getHours() + ":" + horario.getMinutes());
    };

    $scope.salvarServico = () => {
        const validate = validarDiaHorario();
        //Varre a lista de datas para verifica se data selecionada existe        
        if (validate) {
            /* Componente externo! Documentacao:  https://notifyjs.com */
            let field = "vlData";
            let msg = "Data inválida!";
            
            if (validate.horario) {
                field = "horario_inicio";
                msg = "Horário inválido!";
            }

            $("#" + field).notify(
                msg,
                {
                    position:"button"
                },
                "error"
            );
            return;
        }

        var objData = new Date($scope.dia_solicitacao);

        var dataFormatada = 
            objData.getDate() + "/" 
            + (objData.getMonth() + 1) + "/"
            + objData.getFullYear();

        var arrServicoSalvar = {
            'id_servico'         : $scope.id_servico_escolhido,
            'id_forma_pagamento' : 1,
            'id_estado_operacao' : 3,
            'horario_inicio'     : $scope.formatarHorario($scope.horario_inicio),
            'horario_fim'        : $scope.formatarHorario($scope.horario_fim),
            'dia_solicitacao'    : dataFormatada
        }

        // Bloqueia o botão para o usuário não realizar inumeras requisicoes
        $scope.bloquear_btn_servico = true;

        $http.post(
            '../DetalheServico/salvarSolicitacao',
            arrServicoSalvar
        ).success(function(data) {
            $scope.bloquear_btn_servico = false;
            
            const modalAval = $('#modalDetalheServico');
            modalAval.modal();  
            modalAval.modal('close');

            $.notify("Salvo com sucesso!", "success");
        });
    };

    $scope.iniciaSessaoPagSeguro = function() {
        $http.post(
            '../PagSeguro/PagSeguro/getSessaoPagSeguroFromLibrary'
        ).success(function (data) {
            PagSeguroDirectPayment.setSessionId(data);
            PagSeguroDirectPayment.getPaymentMethods({
                success: function(response) {
                    $scope.getDadosCartao();
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