<html lang="pt_BR">
<head>
	<title>Opa! Ajude o Vovô</title>
	<!-- jQuery & Bootstrap -->

	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
</head>

<body ng-app="appAngular" ng-controller="controllerAngular" >
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
								ng-options="listaSexo.descricao for listaSexo in arrListaSexo track by listaSexo.id"
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
				<div class="col-sm-12 col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-12">
	   				Endereço:<hr style="background-color: #ccc;" />
	   			</div>	
	   		</div>	
	   	</div>	

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="pais">Pais:</label>
							<select
								ng-options="listaPais.descricao for listaPais in arrListaPais"
								ng-model="paisSelected"
								ng-change="getListaEstado()"
								name="pais"
								id="pais"
								class="form-control"
							>
								<option value="">Selecione um pais...</option>
							</select>
						</div>
		   		</div>
		   		
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="estado">Estado:</label>
							<select
								ng-options="listaEstado.descricao for listaEstado in arrListaEstado"
								ng-model="estadoSelected"
								name="estado"
								id="estado"
								ng-change="getListaCidade()"
								class="form-control"
							>
								<option value="">Selecione um estado...</option>
							</select>
						</div>
		   		</div>
		   	</div>
		   </div>

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="cidade">Cidade:</label>
							<select
								ng-options="listaCidade.descricao for listaCidade in arrListaCidade"
								ng-model="cidadeSelected"
								name="cidade"
								id="cidade"
								class="form-control"
							>
								<option value="">Selecione um cidade...</option>
							</select>
						</div>
		   		</div>
		   		
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="bairro">Bairro:</label>
							<input type="text" ng-model="bairro" class="form-control" id="bairro" placeholder="Bairro" />
						</div>
		   		</div>
		   	</div>
		   </div>

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="rua">Rua:</label>
							<input type="text" ng-model="rua" class="form-control" id="rua" placeholder="rua" />
						</div>
		   		</div>
		   		
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="nr_rua">Número da rua:</label>
							<input type="text" ng-model="nr_rua" class="form-control" id="nr_rua" placeholder="nr_rua" />
						</div>
		   		</div>
		   	</div>
		   </div>

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="complemento">Complemento:</label>
							<input type="text" ng-model="complemento" class="form-control" id="complemento" placeholder="complemento" />
						</div>
		   		</div>
		   	</div>
		   </div>

		 	<div class="row">
				<div class="col-sm-12 col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-12">
	   				Endereço:<hr style="background-color: #ccc;" />
	   			</div>	
	   		</div>	
	   	</div>	

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="fone_residencial">Telefone residencial:</label>
							<input type="text" ng-model="fone_residencial" class="form-control" id="fone_residencial" placeholder="fone_residencial" />
						</div>
		   		</div>
		   		
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="fone_comercial">Telefone comercial:</label>
							<input type="text" ng-model="fone_comercial" class="form-control" id="fone_comercial" placeholder="fone_comercial" />
						</div>
		   		</div>
		   	</div>
		   </div>

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="celular">Celular:</label>
							<input type="text" ng-model="celular" class="form-control" id="celular" placeholder="celular" />
						</div>
		   		</div>
		   		
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="email">E-mail:</label>
							<input type="text" ng-model="email" class="form-control" id="email" placeholder="email" />
						</div>
		   		</div>
		   	</div>
		   </div>


		 	<div class="row">
				<div class="col-sm-12 col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-12">
	   				Dados de acesso:<hr style="background-color: #ccc;" />
	   			</div>	
	   		</div>	
	   	</div>


			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<label for="login">Login:</label>
							<input type="text" ng-model="login" class="form-control" id="login" placeholder="login" />
						</div>
		   		</div>		   		
		   	</div>
		   </div>


			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="senha1">Senha:</label>
							<input type="password" ng-model="senha1" class="form-control" id="senha1" placeholder="senha1" />
						</div>
		   		</div>
		   		
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="senha2">Repetir senha:</label>
							<input type="password" ng-model="senha2" class="form-control" id="senha2" placeholder="senha2" />
						</div>
		   		</div>
		   	</div>
		   </div>


			<div class="row">
				<div class="col-md-4 col-md-offset-5">
					<div class="col-sm-12 col-md-6">
						<button type="submit" ng-click="salvar()" class="btn btn-success" ng-show="!is_alterar">
							Salvar
						</button>

						<button type="submit" ng-click="salvar()" class="btn btn-success" ng-show="is_alterar">
							Alterar
						</button>

						<button type="button" ng-click="cancelar()" class="btn btn-danger">
							Cancelar
						</button>
					</div>
				</div>
			</div>

			<br/>
   	</div> <!-- Fim da container do princical do bootstrap -- >
<!-- 
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
			</table> -->
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
	<script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

	<!-- Angular JS -->
	<script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

	<link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
	<script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/app.js"></script>
</body>
</html>