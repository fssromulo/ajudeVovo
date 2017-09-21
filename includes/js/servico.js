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

        $scope.arrListaDiaHorarioAtendimento = 
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

        if (!$scope.informacoesValidas()) {
            console.log("As informações são inválidas");
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
            'descricao' : $scope.horarioAtendimentoSelected['descricao'],
            'nr_dia' : $scope.horarioAtendimentoSelected['nr_dia']
        }

        $http.post(
            '../Servico/salvarDiaDisponivel', 
            arrDiaDisponivelSalvar
        ).success(function (id_diaDisponivel) {
            $scope.salvarHorarioDisponivel(id_diaDisponivel);
        });
    };

    $scope.salvarHorarioDisponivel = function (id_diaDisponivel) {
        
        var horarioInicio = $scope.horario_inicio.getHours() + ":" + $scope.horario_inicio.getMinutes();
        var horarioFim = $scope.horario_fim.getHours() + ":" + $scope.horario_fim.getMinutes();

        var arrHorarioDisponivel = {
            'id_dia_disponivel' : id_diaDisponivel,
            'horario_inicio' : horarioInicio,
            'horario_fim' : horarioFim
        }

        $http.post(
            '../Servico/salvarHorarioDisponivel',
            arrHorarioDisponivel
        ).success(function (data) {
            $scope.arrListaServico = data;
            $scope.cancelar();
        });
    };

    $scope.informacoesValidas = function() {
        
        // TODO: Fazer a verificação de todos os campos
        if ($scope.descricao === null || $scope.valor === null 
            || $scope.horarioInicio === null || $scope.horarioFim === null 
            || $scope.categoriaSelected == undefined
            || $scope.hora_inicio === null || $scope.hora_fim === null) {
            return false;
        } else {
            return true;
        }
    }

    $scope.alterarServico = function() {
        var arrServicoAtualizar = {
            'descricao' : $scope.descricao,
            'valor' : $scope.valor,
            'horarioInicio' : $scope.horarioInicio,
            'horarioFim' : $scope.horarioFim,
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

    $scope.cancelar = function () {
        $scope.is_alterar = false;
        $scope.id_servico = null;
        $scope.descricao = null;
        $scope.valor = null;
        $scope.id_categoria = null;
        $scope.categoriaSelected = null;
        $scope.horaInicio = null;
        $scope.horaFim = null;
        $scope.detalhe = null;
    };

    $scope.carregarAlterar = function(servico) {
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