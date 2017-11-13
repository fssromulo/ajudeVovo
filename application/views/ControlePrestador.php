<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('header.php');
?>

</head>


    <body>  

    <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('menuPrestador.php');
    ?>

  <div ng-app="appAngular" ng-controller="controllerControlePrestador">	
    <div class="container">
		<div class="row">
            <div class="col-md-12 col-sm-10 col-md-offset-1">
                <div class="col-md-12 col-sm-6">
                    <div class="form-group">

                        <a href="javascript:history.back()" class="btn">Voltar</a>
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>
                                            Serviço
                                        </th>
                                        <th>
                                            Idoso
                                        </th>
                                        <th>
                                            Data
                                        </th>
                                        <th>
                                            Horário Início
                                        </th>
                                        <th>
                                            Horário Fim
                                        </th>
                                        <th>
                                            Situação
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lista in arrListaServico">
                                        <td>
                                            {{lista.descricao | limitTo:20 }}...
                                        </td>
                                        <td>
                                            {{lista.nome}}
                                        </td>
                                        <td>
                                            {{lista.dia_solicitacao}}
                                        </td>
                                        <td>
                                            {{lista.horario_inicio}}
                                        </td>
                                        <td>
                                            {{lista.horario_fim}}
                                        </td>
                                        <td>
                                            {{lista.ds_estado_atual}}
                                        </td>
                                        <td ng-show="{{lista.id_estado_operacao}} == 3">
                                            <button 
                                                title="Aceitar" 
                                                ng-click="aceitar(lista.id_servico_solicitacao)"
                                                class="btn btn-success"
                                                style="font-size: 16px;">
                                                    <span class="glyphicon glyphicon-thumbs-up" >
                                                    </span>
                                            </button>
                                            <button 
                                                title="Negar"
                                                ng-click="negar(lista.id_servico_solicitacao)"
                                                class="btn btn-danger"
                                                style="font-size: 16px;">
                                                    <span class="glyphicon glyphicon-thumbs-down"  >
                                                    </span>
                                            </button>
                                        </td>        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

    <!-- Referência do arquivo JS do plugin após carregar o jquery -->
    
    <script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

    <link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
    <script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>


    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="../includes/js/ConsultaControlePrestador.js"></script>
</body>
</html>
