let app = angular.module(
    "appAngular",
    [
        'ui.materialize',
        'angular-loading-bar'
    ]
);

app.controller("controllerServico", function($scope, $http, $timeout) {

    $scope.__construct = function() {

        $scope.arrServico = {
            'id_categoria' : null,
            'descricao' : null,
            'detalhe' : null,
            'valor' : 0,
        }

        $scope.id_categoria = null;
        $scope.descricao = null;
        $scope.valor = null;
        $scope.detalhe = null;
        
        $scope.valorConvertido = 0;
        $scope.arrListaAtendimento = [];
        $scope.arrListaCategoria = [];
        $scope.categoriaSelected = {
            'id_categoria': null
        };

        $scope.arrListaAtendimentoAdicionados = [];
        $scope.arrListaAtendimentoExcluidos = [];

        $("#valor").maskMoney({thousands:'.',decimal:','});

        $scope.desabilitarBotoes = false;

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
    };

    $scope.getCategorias = function() {
        $http.post(
            '../Servico/getCategorias'
        ).success(function (data){
            $scope.arrListaCategoria = data;

            if ($scope.id_servico) {
                $scope.getServicoParaEdicao();
            }
        });
    };

    $scope.salvarServico = function() {
        if ((!$scope.informacoesServicoValidas()) || (!$scope.temAtendimentoInserido())) {
            return;
        }

        $scope.desabilitarBotoes = true;

        let arrServicoSalvar = {
            'descricao' : $scope.descricao,
            'valor' : $scope.valorConvertido,
            'detalhe' : $scope.detalhe,
            'listaAtendimento': $scope.arrListaAtendimento,
            'id_categoria' : $scope.categoriaSelected['id_categoria']
        }

        $http.post(
            '../Servico/salvar',
            arrServicoSalvar
        ).success(function (data) {
            $scope.arrListaServico = data;
            $.notify("Serviço salvo!", "success");
            $scope.voltar();
        });
    };

    $scope.valorServicoValido = function () {
        $scope.valorConvertido = $("#valor").val().replace('R$', '').replace('.', '');
        $scope.valorConvertido = $scope.valorConvertido.replace(',', '.');
        $scope.valorConvertido = parseFloat($scope.valorConvertido);
        
        if (isNaN($scope.valorConvertido)) {
            $("#valor")
                .notify("O valor mínimo para serviços é de R$1,00", "error")
                .val("")
                .focus();

            return false;
        }

        if ($scope.valorConvertido < 1) {
            $("#valor")
                .notify("O valor mínimo para serviços é de R$1,00", "error")
                .val("")
                .focus();

            return false;
        }
        
        if ($scope.valorConvertido > 250) {
            $("#valor")
                .notify("O valor máximo para serviços é de R$ 250,00", "error")
                .val("")
                .focus();

            return false;
        }

        return true;
    };

    $scope.informacoesServicoValidas = function() {
        if ($scope.descricao === null || $scope.categoriaSelected == undefined || $scope.valor === null) {
            $.notify("As informações do serviço são inválidas", "error");
            return false;
        }

        if(!$scope.valorServicoValido()) {
            return false;
        }

        return true;
    };

    $scope.adicionarDiaAtendimento = function() {
        if (!$scope.informacoesAtendimentoValidas()) {
            return false;
        }

        if (!$scope.horarioInicioMenorQueHorarioFim()) {
            return false;
        }

        let arrDiaAtendimento = {
            'dia': $scope.diaAtendimentoSelected['descricao'],
            'horario_inicio': $scope.formatarHorario($scope.horario_inicio),
            'horario_fim': $scope.formatarHorario($scope.horario_fim),
            'nr_dia' : $scope.diaAtendimentoSelected['nr_dia']
        }

        if ($scope.id_servico) {
            $scope.arrListaAtendimentoAdicionados.push(arrDiaAtendimento);
        }

        $scope.arrListaAtendimento.push(arrDiaAtendimento);

        $scope.limparCamposHorarioAtendimento();
    };

    $scope.horarioConflitante = function(arrListaAtendimento) {
        //TODO: Varrer o array arrListaAtendimento e fazer a verificação do range de horários
    };

    $scope.horarioInicioMenorQueHorarioFim = function() {
        let horaInicio = $scope.horario_inicio.getHours();
        let minutoInicio = $scope.horario_inicio.getMinutes();

        let horaFim = $scope.horario_fim.getHours();
        let minutoFim = $scope.horario_fim.getMinutes();


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
        if($scope.desabilitarBotoes) {
            return;  
        }

        if($scope.id_servico) {
            $scope.arrListaAtendimentoExcluidos.push(id_dia_disponivel);
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
            $.notify("Nenhuma data de atendimento foi inserida", "error");
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

    $scope.getServicoParaEdicao = function() {
        $http.post(
            '../Servico/getServicoParaEdicao', $scope.id_servico
        ).success(function (data) {
            $scope.carregarServicoParaEdicao(data);
        });
    };

    $scope.carregarServicoParaEdicao = function(servico) {
        $scope.arrServico = {
            'id_categoria' : servico['id_categoria'],
            'descricao' : servico['descricao'],
            'valor' : servico['valor'],
            'detalhe' : servico['detalhe']
        }
        
        $scope.descricao = servico['descricao'];
        $scope.valor = servico['valor'];
        $scope.detalhe = servico['detalhe'];

        for (let i = $scope.arrListaCategoria.length - 1; i >= 0; i--) {
            if ($scope.arrListaCategoria[i].id_categoria == servico['id_categoria']) {
                $scope.categoriaSelected = $scope.arrListaCategoria[i];
            }
        }

        $scope.getDiasAtendimento(servico['id_servico']);
    };

    $scope.getDiasAtendimento = function(id_servico) {        
        $http.post(
            '../Servico/buscarDiaAtendimentoServico', id_servico
        ).success(function (data) {
            $scope.arrListaAtendimento = data;
        });
    };

    $scope.atualizarServico = function() {        
        if ((!$scope.informacoesServicoValidas()) || (!$scope.temAtendimentoInserido())) {
            return;
        }

        $scope.desabilitarBotoes = true;

        let arrServicoEditado = {
            'id_categoria' : $scope.categoriaSelected['id_categoria'],
            'descricao' : $scope.descricao,
            'valor' : $scope.valorConvertido,
            'detalhe' : $scope.detalhe,
            'listaAtendimento': $scope.arrListaAtendimento,
        }

        arrServicoEditado['id_servico'] = $scope.id_servico;

        $http.post(
            '../Servico/atualizarServico',
            arrServicoEditado
        ).success(function (data) {
            $scope.excluirDiasAtendimentoEditados();
            $scope.arrListaServico = data;
            $.notify("Serviço alterado!", "success");
            $scope.voltar();
        });
    };

    $scope.excluirDiasAtendimentoEditados = function() {
        if ($scope.arrListaAtendimentoExcluidos == 0) {
            return;
        }

        $http.post(
            '../Servico/excluirDiasAtendimentoEditados',
            $scope.arrListaAtendimentoExcluidos
        );
    };

    $scope.voltar = function() {
        $timeout(function(argument) {
            location.href = '../ListarServico/';
        }, 3000);
    };

    $scope.$watch('arrListaCategoria',
        function(ds_novo, ds_velho) {
            $timeout(function(argument) {
                $('select').material_select();
            });
        }
    );

    angular.element(document).ready(function () {
		$scope.__construct();
	});
});