<html lang="pt_BR">
<head>
	<title>CodeIgniter & AngularJS</title>
	<!-- jQuery & Bootstrap -->
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="../includes/materialize/css/materialize.min.css"  type="text/css" rel="stylesheet" />


</head>

<body ng-app="appAngular" ng-controller="controllerAngular">
	<div >
	<div class="container">
  <div class="row">
    <form method="POST" onsubmit="return false;" ng-init="listaPessoas()">

      <div class="row">
        <div class="input-field col s6">
          <input id="fone" type="text" class="validate" ng-model="fone" >
          <label class="campos-alterar active" for="fone">Last Name</label>
        </div>
        <div class="input-field col s6">
          <input id="Nome" ng-model="nome_pessoa" type="text" class="validate">
          <label class="campos-alterar active" for="Nome">First Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate" ng-model="email">
          <label class="campos-alterar active" for="email">Email</label>
        </div>
      </div>


				
		<button type="submit" ng-click="salvar()" class="btn btn-success" ng-show="!is_alterar">
			Salvar
		</button>


		<button type="submit" ng-click="salvar()" class="btn btn-success" ng-show="is_alterar">
			Alterar
		</button>

		<button type="button" ng-click="cancelar()" class="btn btn-danger">
			Cancelar
		</button>

    </form>
  

			<table class="responsive-table">
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
				  		<span style="cursor:pointer;" class="material-icons" ng-click="carregarAlterar(pessoa)">mode_edit</span>
				  		<span
				  			style="cursor:pointer;"
				  			data-target="modal1" class="modal-trigger material-icons "
				  			ng-click="carregaExcluir(pessoa)"
				  		>close			  			
				  		</span>
				  </td>
				</tr>
			</table>
		</div>
	</div>
	</div>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Confirmação</h4>
      <p>Deseja realmente excluir este registro?</p>
    </div>
    <div class="modal-footer">
       <button  class="modal-action modal-close waves-effect waves-red btn-flat">Não</button>
      <button ng-click="excluir()" type="button" class="modal-action modal-close waves-effect waves-green btn-flat">Sim</button>
    </div>
  </div>

	<script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>


  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>

	<!-- Angular JS -->
	<script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

		<link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
	<script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/app.js"></script>
</body>

</html>