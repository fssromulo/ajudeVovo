<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('header.php');
?>
</head>


<body>  

    <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('menuContratante.php');
    ?>
  <div ng-app="appAngular" ng-controller="controllerDetalheServico">	
    <div class="container">
		<div class="row">
                    <div class="col-md-12 col-sm-10 col-md-offset-1">
                        <div class="col-md-12 col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>
                                                Serviço
                                            </th>
                                            <th>
                                                Categoria
                                            </th>
                                            <th>
                                                Ajudante
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
                                            <td title="{{lista.servico}}">
                                                {{lista.servico | limitTo:20 }}...
                                            </td>
                                            <td>
                                                {{lista.categoria}}
                                            </td>
                                            <td>
                                                {{lista.ajudante}}
                                            </td>
                                            <td>
                                                {{lista.dia}}
                                            </td>
                                            <td>
                                                {{lista.horario_inicio}}
                                            </td>
                                            <td>
                                                {{lista.horario_fim}}
                                            </td>
                                            <td>
                                                {{lista.situacao}}
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

    
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

    <!-- Referência do arquivo JS do plugin após carregar o jquery -->
    
    <script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

    <link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
    <script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>


    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="../includes/js/ConsultaControleSolicitante.js"></script>
</body>
</html>
