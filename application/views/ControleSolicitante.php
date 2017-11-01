<html lang="pt_BR">
<head>
	<title>Opa! Ajude o Vovô</title>
	<!-- jQuery & Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../includes/star-rating/css/star-rating.min.css" media="all" type="text/css"/>
	
	<link rel="stylesheet" href="../includes/css/hero.css">
	
	
</head>

<body>
  <div ng-app="appAngular" ng-controller="controllerDetalheServico">	
    <div class="container">
		<div class="row">
                    <div class="col-md-12 col-sm-10 col-md-offset-1">
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group">
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
