<html lang="pt_BR">
<head>
	<title>CodeIgniter & AngularJS</title>


	<!-- jQuery & Bootstrap -->
  <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.min.js"></script>
  <link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
  <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

	<!-- Angular JS -->
  <script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/app.js"></script>

</head>

<body ng-app="appAngular">
	<div ng-controller="controllerAngular">

		<div class="col-md-6 col-md-offset-3">	
			<br/>
			<form action="" method="POST" class="" onsubmit="return false;" ng-init="listaPessoas()">
				<div class="form-group">
					<input type="text" ng-model="nome_pessoa" class="form-control" name="nome_pessoa" placeholder="Nome..." />
				</div>
				
				
				<div class="form-group">
					<input type="text" ng-model="email" class="form-control" name="email" placeholder="Email..." />
				</div>
				
				<div class="form-group">
					<input type="text" ng-model="fone" class="form-control" name="fone" placeholder="Fone..." />
				</div>
				
				<button type="button" ng-click="salvar()" class="btn btn-success" ng-show="!is_alterar">
					Salvar
				</button>


				<button type="button" ng-click="salvar()" class="btn btn-success" ng-show="is_alterar">
					Alterar
				</button>

				<button type="button" ng-click="cancelar()" class="btn btn-danger">
					Cancelar
				</button>
			</form>

			<hr/>

			<table class="table table-hover">
  				<tr>
				  <th >Codigo</th>
				  <th >Nome</th>
				  <th >Email</th>
				  <th >Telefone</th>
				  <th >Ações:</th>
				</tr>

  				<tr ng-repeat="pessoa in arrPessoas">
				  <td>{{pessoa.cd_pessoa}}</td>
				  <td>{{pessoa.nm_pessoa}}</td>
				  <td>{{pessoa.email}}</td>
				  <td>{{pessoa.fone}}</td>
				  <td >
				  		<span style="cursor:pointer;" class="glyphicon glyphicon-pencil" ng-click="carregarAlterar(pessoa)"></span>
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

<div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4>
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


</body>

</html>