<html lang="pt_BR">
<head>
	<title>CodeIgniter & AngularJS</title>
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

	<!-- jQuery & Bootstrap -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<!-- Angular JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/app.js"></script>
</head>

<body ng-app="appAngular">
	<div ng-controller="controllerAngular">

		<div class="col-md-5">	
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
				
				<button type="button" ng-click="criarPost()" class="btn btn-danger">
					Salvar Angular
				</button>
			</form>

			<hr/>

			<table class="table table-hover">
  				<tr>
				  <th >Codigo</th>
				  <th >Nome</th>
				  <th >Email</th>
				  <th >Telefone</th>
				</tr>

  				<tr ng-repeat="pessoa in arrPessoas">
				  <td >{{pessoa.cd_pessoa}}</td>
				  <td >{{pessoa.nm_pessoa}}</td>
				  <td >{{pessoa.email}}</td>
				  <td >{{pessoa.fone}}</td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>