<html lang="pt_BR">
<head>
	<title>Opa! Ajude o vovô</title>
	<!-- jQuery & Bootstrap -->

	<!-- <link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" /> -->
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
</head>

		<div class="container-fluid" ng-controller="ctrlCartaoCredito">
		 	<div class="row">
				<div class="col-sm-12 col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="numero_cartao">Número do Cartão:</label>
							<input type="text" ng-model="numero_cartao" class="form-control" id="numero_cartao" placeholder="numero_cartao" />
						</div>
		   		</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="dt_validade">Data de Validade:</label>
							<input type="text" ng-model="dt_validade" class="form-control" id="dt_validade" placeholder="dt_validade" />
						</div>
		   		</div>
		   	</div>
	   	</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="nome_titular">Nome do Titular:</label>
							<input type="text" ng-model="nome_titular" class="form-control" id="nome_titular" placeholder="nome_titular" />
						</div>
		   			</div>
		   		</div>
		   </div>

			<div class="row">
				<div class="col-md-6 col-md-offset-4">
					<div class="col-sm-12 col-md-12">
						<button type="button" ng-click="salvarCartao()" class="btn btn-success" ng-show="!is_alterar">
							Salvar
						</button>

						<button type="button" ng-click="salvarCartao()" class="btn btn-success" ng-show="is_alterar">
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

		<!-- 	<table class="table table-striped">
  				<tr>
				  <th >Codigo Cartão:</th>
				  <th >Nome do Titular:</th>
				  <th >Nome da Pessoa:</th>
				  <th >Número do Cartão:</th>
				  <th >Data de Validade:</th>
				  <th >Ações:</th>
				  
				</tr>

  				<tr ng-repeat="cartao in arrCartao">
				  <td>{{cartao.id_cartao}}</td>
				  <td>{{cartao.nome_titular}}</td>
				  <td>{{cartao.nome_pessoa}}</td>
				  <td>{{cartao.numero_cartao}}</td>
				  <td>{{cartao.data_validade}}</td>
				  <td >
				  		<span style="cursor:pointer;" class="glyphicon glyphicon-edit" ng-click="carregarAlterar(cartao)"></span>
				  		<span
				  			style="cursor:pointer;"
				  			class="glyphicon glyphicon-remove"
				  			data-toggle="modal"
				  			data-target="#modal_excluir"
				  			ng-click="carregaExcluir(cartao)"
				  		>				  			
				  		</span>
				  </td>
				</tr>
		 </table> -->
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


	<!-- <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script> -->

	<!-- Compiled and minified JavaScript -->
	<!-- <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>   -->

	<!-- Angular JS -->
	<!-- <script type="text/javascript" src="../includes/angular/angular.min.js"></script>   -->

	<!-- <link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' /> -->
	<!-- <script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script> -->

	
	<!-- <script type="text/javascript" src="../includes/js/pessoa.js?<?php echo date('YmdHis');?>"></script>
	<script type="text/javascript" src="../includes/js/cartaoCredito.js"></script> -->
</html>