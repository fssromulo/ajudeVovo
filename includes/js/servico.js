var app = angular.module(
    "appAngular",
    [
        'angular-loading-bar',
        'ui.materialize'
    ]
);

app.controller("controllerServico", function($scope, $http) {

    $scope.__construct = function() {

        $arrServico = {
            'id_categoria' : null,
            'descricao' : null,
            'detalhe' : null,
            'valor' : 0,
        }

        $scope.id_categoria = null;
        $scope.is_alterar = false;
        $scope.valorConvertido = 0;
        $scope.arrListaAtendimento = [];
        $scope.arrListaCategoria = [];

        $scope.arrListaAtendimentoAdicionados = [];
        $scope.arrListaAtendimentoExcluidos = [];

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

        $scope.getCategorias();

        if ($scope.id_servico) {
            console.log("js:serviço está sendo alterado");
            $scope.getServicoParaEdicao();
        }
    };

    $scope.getCategorias = function() {
        console.log("js:getCategorias");
        $http.post(
            '../Servico/getCategorias'
        ).success(function (data){
            $scope.arrListaCategoria = data;
        });
    };

    $scope.salvarServico = function() {
    console.log("js:salvarServico");
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

    $scope.valorServicoValido = function () {
        console.log("js:valorServicoValido");
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
            $.notify("As informações do serviço são inválidas", "error");
            return false;
        }

        if($scope.valorServicoValido()) {
            return false;
        }

        return true;
    };

    $scope.adicionarDiaAtendimento = function() {
        console.log("js:adicionarDiaAtendimento");
        if (!$scope.informacoesAtendimentoValidas()) {
            console.log("js:informacoesAtendimentoValidas");
            return false;
        }

        if (!$scope.horarioInicioMenorQueHorarioFim()) {
            console.log("js:horarioInicioMenorQueHorarioFim");
            return false;
        }

        var arrDiaAtendimento = {
            'dia': $scope.diaAtendimentoSelected['descricao'],
            'horario_inicio': $scope.formatarHorario($scope.horario_inicio),
            'horario_fim': $scope.formatarHorario($scope.horario_fim),
            'nr_dia' : $scope.diaAtendimentoSelected['nr_dia']
        }

        if ($scope.id_servico) {
            $scopce.arrListaAtendimentoAdicionados.push(arrDiaAtendimento);
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

    $scope.removerDiaAtendimento = function(index, id_dia_disponivel) {
        console.log("js:removerDiaAtendimento");
        console.log("js:id_servico: " + $scope.id_servico);

        if($scope.id_servico) {
            $scope.arrListaAtendimentoExcluidos.push(id_dia_disponivel);
            console.log("ABC: " + $scope.arrListaAtendimentoExcluidos);
        }

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
        // $scope.is_alterar = false;
        // $scope.descricao = null;
        // $scope.valor = null;
        // $scope.id_categoria = null;
        // $scope.diaAtendimentoSelected = null;
        // $scope.categoriaSelected = null;
        // $scope.hora_inicio = null;
        // $scope.hora_fim = null;
        // $scope.detalhe = null;
        // $scope.arrListaAtendimento = [];
    };

    $scope.getServicoParaEdicao = function() {
        console.log("js:getServicoParaEdicao");
        $http.post(
            '../Servico/getServicoParaEdicao', $scope.id_servico
        ).success(function (data) {
            $scope.carregarServicoParaEdicao(data);
        });
    };

    $scope.carregarServicoParaEdicao = function(servico) {
        console.log("js:carregarServicoParaEdicao");

        $scope.arrServico = {
            'id_categoria' : $scope.arrListaCategoria[servico['id_categoria']],
            'descricao' : servico['descricao'],
            'valor' : servico['valor'],
            'detalhe' : servico['detalhe']
        }
        
        $scope.descricao = servico['descricao'];
        $scope.valor = servico['valor'];
        $scope.detalhe = servico['detalhe'];
        $scope.categoriaSelected = $scope.arrListaCategoria[servico['id_categoria']];
        $scope.getDiasAtendimento(servico['id_servico']);
    }

    $scope.getDiasAtendimento = function(id_servico) {
        console.log("js:getDiasAtendimento");
        
        $http.post(
            '../Servico/buscarDiaAtendimentoServico', id_servico
        ).success(function (data) {
            $scope.arrListaAtendimento = data;
        });
    }

    $scope.atualizarServico = function() {
        console.log("js:atualizarServico");

        if ((!$scope.informacoesServicoValidas()) || (!$scope.temAtendimentoInserido())) {
            return;
        }

        var arrServicoEditado = {
            'id_categoria' : $scope.categoriaSelected['id_categoria'],
            'descricao' : $scope.descricao,
            'valor' : $scope.valor,
            'detalhe' : $scope.detalhe
        }

        // Ver com o Rômulo se essas validações são válidas.
        // Ver sobre o tratamento do update ServicoDB.

        // if ($scope.categoriaSelected['id_categoria'] != $scope.arrServico['id_categoria']['id_categoria']) {
        //     console.log("Categoria alterada");
        //     arrServicoEditado['id_categoria'] = $scope.categoriaSelected['id_categoria'];
        // }

        // if ($scope.descricao != $scope.arrServico['descricao']) {
        //     console.log("Descrição alterada");
        //     arrServicoEditado['descricao'] = $scope.descricao;
        // }

        // if ($scope.valor != $scope.arrServico['valor']) {
        //     console.log("Valor alterado");
        //     arrServicoEditado['valor'] = $scope.valor;
        // }

        // if ($scope.detalhe != $scope.arrServico['detalhe']) {
        //     console.log("Detalhe alterado");
        //     arrServicoEditado['detalhe'] = $scope.detalhe;
        // }

        arrServicoEditado['id_servico'] = $scope.id_servico;

        $http.post(
            '../Servico/atualizarServico',
            arrServicoEditado
        ).success(function (data) {
            $scope.excluirDiasAtendimentoEditados();
            $scope.arrListaServico = data;
        });
    }

    $scope.excluirDiasAtendimentoEditados = function() {
        if ($scope.arrListaAtendimentoExcluidos == 0) {
            return;
        }

        http.post(
            '../Servico/excluirDiasAtendimentoEditados',
            $scope.arrListaAtendimentoExcluidos
        ).success(function(data){
            
        });
    }

    angular.element(document).ready(function () {
		$scope.__construct();
	});
});