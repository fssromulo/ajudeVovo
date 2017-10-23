<html lang="pt_BR">
<head>
	<title>Opa! Ajude o Vovô</title>
	<!-- jQuery & Bootstrap -->

	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../includes/star-rating/css/star-rating.min.css" media="all" type="text/css"/>
	<link rel="stylesheet" href="../includes/css/hero.css">
</head>

<body>
	<div
		ng-app="appAngular"
		ng-controller="controllerAngular"
		class="container"
	>
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<label for="pesquisa">Pesquise:</label>
						<input
							type="text" 
							ng-model="pesquisa" 
							id="pesquisa" 
							name="pesquisa" 
							class="form-control" 
							id="contratante" 
							placeholder="Insira o nome do serviço ou categoria desejada...">
					</div>
				</div>
			</div>
		</div>
		<div 
			class="col-md-3 col-sm-6 hero-feature" 
			ng-repeat="servico in arrServicos | filter:pesquisa " 
			after-load-services-directive>
			<div class="thumbnail text-center novas-cards" style="height:600px;">
				<img 
					class="novas-fotos" 
					ng-src="{{servico.url_img_categoria}}" 
					alt="{{servico.ds_categoria}}"> 
				<div class="caption">
					<h3>{{servico.ds_categoria}}</h3>
					<p>{{servico.nm_prestador}}</p>
					<div>
						<input
							 class="kv-fa-heart rating-loading"
							 data-min="0" 
							 data-max="5" 
							 value="{{servico.qt_estrela}}"
							 data-size="xs">
						<p class="pessoas-atendidas pull-right">{{servico.qt_servico}} pessoas atendidas</p>
					</div>
					<br>
					<p></p>
					<p>
						{{servico.ds_detalhe}}
					</p>
					<p class="price">R$ {{servico.valor}}</p>
					<p>
						<button 
							ng-click="goToDetail(servico.id_servico)"
							class="btn btn-primary btn-contratar">Mais informações
						</button>
					</p>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalDetalheServico" tabindex="-1" role="dialog" aria-labelledby="modalDetalheServicoLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="modalDetalheServicoLabel">Solicitação de serviços</h4>
		      </div>
		      <div class="modal-body">
		      	<?php
		      		$this->load->view('DetalheServico.php');
		      	?>	 
		      </div>
		    </div>
		  </div>
		</div>

	</div>


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  
	
    <!-- <script type="text/javascript" src="../includes/js/locales/bootstrap-datepicker.pt-BR.min.js"></script> -->
    <script type="text/javascript" src="../includes/js/bootstrap-datepicker.js"></script>
	<script src="../includes/star-rating/js/star-rating.min.js" type="text/javascript"></script>
	<!-- Angular JS -->
	<script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

	<link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
	<script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

    <!-- Referência do arquivo JS do plugin após carregar o jquery -->
    <!-- Datepicker -->


	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/ServicoClienteDetalhe.service.js"></script>
	<script type="text/javascript" src="../includes/js/ConsultaServicoCliente.controller.js"></script>
	<script type="text/javascript" src="../includes/js/DetalheServico.js"></script>
</body>
</html>