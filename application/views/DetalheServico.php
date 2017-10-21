<html lang="pt_BR">
<head>
	<title>Opa! Ajude o Vovô</title>
	<!-- jQuery & Bootstrap -->

	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../includes/star-rating/css/star-rating.min.css" media="all" type="text/css"/>
	
	<link rel="stylesheet" href="../includes/css/hero.css">
	
	<link rel="stylesheet" type="text/css"  href="../includes/css/datetimepicker/bootstrap-datepicker.min.css" />
</head>

<body ng-app="appAngular" ng-controller="controllerDetalheServico">
	<div class="container">
		<div class="row">
			<form>
				<div class="form-row">
				   <div class="col">
				      <label for="nomeServico">Serviço:</label>
				 	  <input class="form-control" type="text" ng-model="arrListaServico.descricao" id="descricao" placeholder="descricao" readonly/>
				    </div>
				    <div class="col">
				      <label for="categoriaServico">Categoria:</label>
				 	  <input class="form-control" type="text" ng-model="arrListaServico.categoria" placeholder="Jardim" readonly>
				    </div>
				</div>

			    <div class="form-group">
			    	</br>
				 	<h2>Horários Disponíveis</h2>
				 	</br></br>
				 	
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-md-offset-1">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>
                                                Dia da Semana
                                            </th>
                                            <th>
                                                Horário Início
                                            </th>
                                            <th>
                                                Horário Fim
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="lista in arrListaDiaHorario">
                                            <td>
                                                {{lista.dia}}
                                            </td>
                                            <td>
                                                {{lista.horario_inicio}}
                                            </td>
                                            <td>
                                                {{lista.horario_fim}}
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

				</div>

			    <div class="row">
	                <div class="form-group">
	                    <label for="dia">Dia:</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input id="vlData" type="text" class="form-control" ng-model="dia">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <label for="horario_inicio">Horário de Início </label>
	                    <input type="time" ng-model="horario_inicio" id="horario_inicio"  ng-model="horario_inicio" name="horario_inicio" class="form-control" required/>
	    
	                    <label for="horario_fim">Horário de Fim </label> 
	                    <input type="time" ng-model="horario_fim" id="horario_fim"  ng-model="horario_fim" name="horario_fim" class="form-control" required/>


	                
	                    <button type="button" ng-click="salvarServico()" class="btn btn-primary">
	                        Adicionar
	                    </button>
	                </div>
	            </div>
            </form>
            
            		       

            
			   
   	
    
    
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

    <!-- Referência do arquivo JS do plugin após carregar o jquery -->
    <!-- Datepicker -->

    <script type="text/javascript" src="../includes/js/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script type="text/javascript" src="../includes/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

    <link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
    <script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>


    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="../includes/js/DetalheServico.js"></script>
</body>
</html>
