var app =  angular.module(
	"appAngular",
 	[
         'angular-loading-bar'
 	]
);

app.controller("controllerServico", function($scope, $http) {

    $scope.__construct = function() {

        $scope.id_servico = null;
        $scope.id_categoria = null;
        $scope.is_alterar = false;
        $scope.arrListaAtendimento = [];

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

        return;

        if ((!$scope.informacoesServicoValidas()) || (!$scope.temAtendimentoInserido())) {
            return;
        }

        var arrServicoSalvar = {
            'descricao' : $scope.descricao,
            'valor' : $scope.valor,
            'detalhe' : $scope.detalhe,
            'id_categoria' : $scope.categoriaSelected['id_categoria'],
            // TODO: Pegar o id do prestador que vai estar logado
            'id_prestador' : 1,
        }

        $http.post(
            '../Servico/salvar',
            arrServicoSalvar
        ).success(function (id_servico) {
            $scope.salvarDiaDisponivel(id_servico);
        });
    };

    $scope.salvarDiaDisponivel = function(id_servico) {
        var arrDiaDisponivelSalvar = {
            'id_servico' : id_servico,
            'descricao' : $scope.diaAtendimentoSelected['descricao'],
            'nr_dia' : $scope.diaAtendimentoSelected['nr_dia']
        }

        $http.post(
            '../Servico/salvarDiaDisponivel', 
            arrDiaDisponivelSalvar
        ).success(function (id_diaDisponivel) {
            $scope.salvarHorarioDisponivel(id_diaDisponivel);
        });
    };

    $scope.salvarHorarioDisponivel = function (id_diaDisponivel) {
        var arrHorarioDisponivel = {
            'id_dia_disponivel' : id_diaDisponivel,
            'horario_inicio' : $scope.formatarHorario($scope.horario_inicio),
            'horario_fim' : $scope.formatarHorario($scope.horario_fim)
        }

        $http.post(
            '../Servico/salvarHorarioDisponivel',
            arrHorarioDisponivel
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.cancelar();
        });
    };

    $scope.alterarServico = function() {
        var arrServicoAtualizar = {
            'descricao' : $scope.descricao,
            'valor' : $scope.valor,
            //TODO 
            // 'horarioInicio' : $scope.horarioInicio,
            // 'horarioFim' : $scope.horarioFim,
            'id_categoria' : $scope.categoriaSelected['id_categoria']
        }

        $http.post(
            '../Servico/alterar',
            arrServicoAtualizar
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.cancelar();
        });

    };

    $scope.excluirServico = function() {
        var arrServicoExcluir = {
            "id_servico" : $scope.id_servico
        }

        $http.post(
            '../Servico/excluir',
            arrServicoExcluir
        ).success(function (data) {
            $('#modal_excluir').modal('toggle');
            $scope.arrListaServico = data;
        });
    };

    $scope.informacoesServicoValidas = function() {        
        if ($scope.descricao === null || $scope.categoriaSelected == undefined || $scope.valor === null) {
            console.log("As informações do serviço são inválidas");
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

        // if (!$scope.horarioConflitante()) {
        //     return false;
        // }

        var arrDiaAtendimento = {
            'dia': $scope.diaAtendimentoSelected['descricao'],
            'horario_inicio': $scope.formatarHorario($scope.horario_inicio),
            'horario_fim': $scope.formatarHorario($scope.horario_fim),
        }

        $scope.arrListaAtendimento.push(arrDiaAtendimento);

        $scope.limparCamposHorarioAtendimento();
    };

    $scope.horarioConflitante = function(arrListaAtendimento) {
        //TODO: Varrer a lista arrListaAtendimento e fazer a verificação do range de horários
    };

    $scope.horarioInicioMenorQueHorarioFim = function() {
        var horaInicio = $scope.horario_inicio.getHours();
        var minutoInicio = $scope.horario_inicio.getMinutes();

        var horaFim = $scope.horario_fim.getHours();
        var minutoFim = $scope.horario_fim.getMinutes();


        if (horaInicio > horaFim) {
            console.log("O horário de início é menor do que o horário de fim do atendimento");
            return false;
        }

        if ((horaInicio == horaFim) && (minutoInicio > minutoFim)) {
            console.log("O horário de início é menor do que o horário de fim do atendimento");
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
        if ($scope.diaAtendimentoSelected == undefined || $scope.horario_inicio == null || $scope.horario_fim == null) {
            console.log("As informações de atendimento são inválidas");
            return false;
        }
     
        return true;
    };

      $scope.temAtendimentoInserido = function() {
        if ($scope.arrListaAtendimento == 0) {
            console.log("Nenhuma data de atendimento foi inserida");
            return false;
        }
        
        return true;
    };

    $scope.formatarHorario = function(horario) {
        return (horario.getHours() + ":" + horario.getMinutes());
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
    };

    $scope.carregarAlterar = function(servico) {
        //TODO Buscar os horários do banco
        $scope.is_alterar = true;
        $scope.servico = servico.id_servico;
        $scope.descricao = servico.descricao;
        $scope.valor = servico.valor;
        $scope.categoriaSelected = {"id_categoria" : servico.id_categoria  };
    };

    $scope.carregarExcluir = function(servico) {
        $scope.id_servico = servico.id_servico;
    };

    angular.element(document).ready(function () {
		$scope.__construct();	
	});
});