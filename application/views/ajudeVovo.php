<html lang="pt_BR">
<head>
	<title>Opa! Ajude o Vovô</title>
	<!-- jQuery & Bootstrap -->
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
</head>

<body ng-app="appAngular" ng-controller="controllerAngular">
		<div class="container-fluid">
		 	<div class="row">
				<div class="col-sm-12 col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="nome">Nome:</label>
							<input type="text" ng-model="nome" class="form-control" id="nome" placeholder="nome" />
						</div>
		   		</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="dt_nascimento">Data:</label>
							<input type="text" ng-model="dt_nascimento" class="form-control" id="dt_nascimento" placeholder="dt_nascimento" />
						</div>
		   		</div>
		   	</div>
	   	</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="rg">RG:</label>
							<input type="text" ng-model="rg" class="form-control" id="rg" placeholder="rg" />
						</div>
		   		</div>
		   		
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="cpf">CPF:</label>
							<input type="text" ng-model="cpf" class="form-control" id="cpf" placeholder="cpf" />
						</div>
		   		</div>
		   	</div>
		   </div>

			<div class="row">
				<div class="row col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="sexo">Sexo:</label>
							<select
								ng-options="listaSexo.descricao for listaSexo in arrListaSexo track by listaSexo.valor"
								ng-model="sexoSelected"
								name="sexo"
								id="sexo"
								class="form-control"
							>
								<option value="">Selecione um sexo...</option>
							</select>
						</div>
		   		</div>
		   	</div>
	   	</div>

			<div class="row">
				<div class="col-md-4 col-md-offset-5">
					<div class="col-sm-12 col-md-6">
						<button type="submit" ng-click="salvarAula()" class="btn btn-success" ng-show="!is_alterar">
							Salvar
						</button>

						<button type="submit" ng-click="salvarAula()" class="btn btn-success" ng-show="is_alterar">
							Alterar
						</button>

						<button type="button" ng-click="cancelar()" class="btn btn-danger">
							Cancelar
						</button>
					</div>
				</div>
			</div>

			<br/>
   	</div> <!-- Fim da container do princical do bootstrap -->

			<table class="table table-striped">
  				<tr>
				  <th >Codigo</th>
				  <th >Nome</th>
				  <th >CPF:</th>
				  <th >Data Nascimento:</th>
				  <th >Sexo:</th>
				  <th >RG:</th>
				  <th >Ações:</th>
				</tr>

  				<tr ng-repeat="pessoa in arrPessoas">
				  <td>{{pessoa.id_pessoa_fisica}}</td>
				  <td>{{pessoa.nome}}</td>
				  <td>{{pessoa.cpf}}</td>
				  <td>{{pessoa.dt_nascimento}}</td>
				  <td>{{pessoa.rg}}</td>
				  <td>{{pessoa.sexo}}</td>
				  <td >
				  		<span style="cursor:pointer;" class="glyphicon glyphicon-edit" ng-click="carregarAlterar(pessoa)"></span>
				  		<span
				  			style="cursor:pointer;"
				  			class="glyphicon glyphicon-remove"
				  			data-toggle="modal"
				  			data-target="#modal_excluir"
				  			ng-click="carregaExcluir(pessoa)"
				  		>				  			
				  		</span>
				  </td>
				</tr>
		 </table>
		</div>
	</div>

	<div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="gridSystemModalLabel">Ajude o vovo!!</h4>
	      </div>
	      <div class="modal-body">
	        
	          Deseja excluir este registro?
	         
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal" >Não</button>
	        <button type="button" class="btn btn-success" ng-click="excluir()">Sim</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>

	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

	<!-- Angular JS -->
	<script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

	<link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
	<script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/ajudeVovo.js"></script>
</body>
</html>