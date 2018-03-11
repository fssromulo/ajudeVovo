var app =  angular.module(
	"appAngular",
 	[
        'ui.materialize',
        'angular-loading-bar' 	]
);

app.controller("controllerServico", function($scope, $http) {

    $scope.__construct = function() {

        $scope.id_servico = null;
        $scope.id_categoria = null;
        $scope.is_alterar = false;
        $scope.valorConvertido = 0;
        $scope.arrListaAtendimento = [];

        $("#valor").maskMoney({thousands:'.',decimal:','});

        $scope.arrListaDiaAtendimento = 
		[
			{
				'descricao' : 'Segunda-feira',
				'nr_dia' : '2'
			},
			{
				'descricao' : 'Terça-feira',
				'nr_dia' : '3'
			},
			{
				'descricao' : 'Quarta-feira',
				'nr_dia' : '4'
			},
			{
				'descricao' : 'Quinta-feira',
				'nr_dia' : '5'
			},
			{
				'descricao' : 'Sexta-feira',
				'nr_dia' : '6'
			},
			{
				'descricao' : 'Sábado',
				'nr_dia' : '7'
			},
			{
				'descricao' : 'Domingo',
				'nr_dia' : '1'
			}
		];
   
        $scope.getServicos();
        $scope.getCategorias();
    };

    $scope.getServicos = function() {
        $http.post(
            '../Servico/getServicos'
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.cancelar();
        });
    };

    $scope.getCategorias = function() {
        $http.post(
            '../Servico/getCategorias'
        ).success(function (data){
            $scope.arrListaCategoria = data;
            $scope.cancelar();
        });
    };

    $scope.salvarServico = function() {

        if ((!$scope.informacoesServicoValidas()) || (!$scope.temAtendimentoInserido())) {
            return;
        }

        var arrServicoSalvar = {
            'descricao' : $scope.descricao,
            'valor' : $scope.valorConvertido,
            'detalhe' : $scope.detalhe,
            'id_categoria' : $scope.categoriaSelected['id_categoria'],
            'listaAtendimento': $scope.arrListaAtendimento,
            'id_categoria' : $scope.categoriaSelected['id_categoria']
        }

        $http.post(
            '../Servico/salvar',
            arrServicoSalvar
        ).success(function (data) {
            $scope.arrListaServico = data;
             $.notify("Serviço salvo!", "success");
            $scope.cancelar();
        });
    };

    // $scope.alterarServico = function() {
    //     var arrServicoAtualizar = {
    //         'descricao' : $scope.descricao,
    //         'valor' : $scope.valor,
    //         //TODO 
    //         // 'horarioInicio' : $scope.horarioInicio,
    //         // 'horarioFim' : $scope.horarioFim,
    //         'id_categoria' : $scope.categoriaSelected['id_categoria']
    //     }

    //     $http.post(
    //         '../Servico/alterar',
    //         arrServicoAtualizar
    //     ).success(function (data) {
    //         $scope.arrListaServico = data;
    //         $scope.cancelar();
    //     });

    // };

    // $scope.excluirServico = function() {
    //     var arrServicoExcluir = {
    //         "id_servico" : $scope.id_servico
    //     }

    //     $http.post(
    //         '../Servico/excluir',
    //         arrServicoExcluir
    //     ).success(function (data) {
    //         $('#modal_excluir').modal('toggle');
    //         $scope.arrListaServico = data;
    //     });
    // };

    $scope.validaValorServico = function () {
        $scope.valorConvertido  = $("#valor").val().replace('.', '');
        $scope.valorConvertido = $scope.valorConvertido.replace(',', '.');
        $scope.valorConvertido = parseFloat($scope.valorConvertido);

        if ( $scope.valorConvertido > 250 ) {
            $("#valor")
                .notify("O valor máximo para serviços é de R$ 250,00", "error")
                .val("")
                .focus();

            return false;
        }

        return true;
    }

    $scope.informacoesServicoValidas = function() {        
        if ($scope.descricao === null || $scope.categoriaSelected == undefined || $scope.valor === null) {
            $.notify("As informações do serviço são inválidas");
            return false;
        }

        return $scope.validaValorServico();
    };

    $scope.adicionarDiaAtendimento = function() {
        if (!$scope.informacoesAtendimentoValidas()) {
            return false;
        }

        if (!$scope.horarioInicioMenorQueHorarioFim()) {
            return false;
        }

        var arrDiaAtendimento = {
            'dia': $scope.diaAtendimentoSelected['descricao'],
            'horario_inicio': $scope.formatarHorario($scope.horario_inicio),
            'horario_fim': $scope.formatarHorario($scope.horario_fim),
            'nr_dia' : $scope.diaAtendimentoSelected['nr_dia']
        }

        $scope.arrListaAtendimento.push(arrDiaAtendimento);

        $scope.limparCamposHorarioAtendimento();
    };

    $scope.horarioConflitante = function(arrListaAtendimento) {
        //TODO: Varrer o array arrListaAtendimento e fazer a verificação do range de horários
    };

    $scope.horarioInicioMenorQueHorarioFim = function() {
        var horaInicio = $scope.horario_inicio.getHours();
        var minutoInicio = $scope.horario_inicio.getMinutes();

        var horaFim = $scope.horario_fim.getHours();
        var minutoFim = $scope.horario_fim.getMinutes();


        if (horaInicio > horaFim) {
            $.notify("O horário de início é menor do que o horário de fim do atendimento");
            $("#horario_inicio").focus();
            return false;
        }

        if ((horaInicio == horaFim) && (minutoInicio > minutoFim)) {
            $.notify("O horário de início é menor do que o horário de fim do atendimento");
            $("#horario_inicio").focus();
            return false;
        }

        return true;
    };

    $scope.limparCamposHorarioAtendimento = function() {
        $scope.diaAtendimentoSelected = null;
        $scope.horario_inicio = null;
        $scope.horario_fim = null;
    };

    $scope.removerDiaAtendimento = function(index) {
        $scope.arrListaAtendimento.splice(index, 1);
    };

    $scope.informacoesAtendimentoValidas = function() {
        if (
            $scope.diaAtendimentoSelected == undefined ||
            $scope.horario_inicio == null ||
            $scope.horario_fim == null
        ) {
            $.notify("As informações de atendimento são inválidas", "error");        
            $("#diaAtendimento").focus();
            return false;
        }
     
        return true;
    };

      $scope.temAtendimentoInserido = function() {
        if ($scope.arrListaAtendimento == 0) {
            $.notify("Nenhuma data de atendimento foi inserida");
            return false;
        }
        
        return true;
    };

    $scope.formatarHorario = function(horario) {
        /*
            Pega a hora digitada, e adiona o 0 
            porque a hora deve ter 2 digitos
            se já tiver irá remover com o slice(funcao do javascript)
        */
        
        hora = horario.getHours();
        hora = ("0" + hora).slice(-2);

        minutos = horario.getMinutes();
        minutos = ("0" + minutos).slice(-2);
    
        return (hora + ":" + minutos);
    };

    $scope.cancelar = function () {
        $scope.is_alterar = false;
        $scope.id_servico = null;
        $scope.descricao = null;
        $scope.valor = null;
        $scope.id_categoria = null;
        $scope.diaAtendimentoSelected = null;
        $scope.categoriaSelected = null;
        $scope.hora_inicio = null;
        $scope.hora_fim = null;
        $scope.detalhe = null;
        $scope.arrListaAtendimento = [];
    };

    $scope.carregarAlterar = function(servico) {
        //TODO Buscar os horários do banco
        $scope.is_alterar = true;
        $scope.servico = servico.id_servico;
        $scope.descricao = servico.descricao;
        $scope.valor = servico.valor;
        $scope.categoriaSelected = {"id_categoria" : servico.id_categoria  };
    };

    // $scope.carregarExcluir = function(servico) {
    //     $scope.id_servico = servico.id_servico;
    // };

    $scope.sugerirCategoria = function() {
        alert("Prioridade baixa: Implementar mais tarde");
    }

    angular.element(document).ready(function () {
		$scope.__construct();	
	});
});