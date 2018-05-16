<?php
	// Importa o cabeçalho padrao a todas as telas
	$this->load->view('nucleo/header.php');
?>
</head>
<body>  
    <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('MenuContratante.php');
    ?>
	<div
		ng-app="appAngular"
		ng-controller="controllerAngular"
		class="container"
	>
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<div ng-if="filter.categoria">
							<div class="chip">
								Categoria: {{arrCategorias.selectedCategory.descricao}}
								<i class="close material-icons" ng-click="limparItemFiltro('categoria')">close</i>
							</div>
						</div>
						<div ng-if="filter.ajudante">
							<div class="chip">
								Ajudante: {{filter.ajudante}}
								<i class="close material-icons" ng-click="limparItemFiltro('ajudante')">close</i>
							</div>
						</div>
						<div ng-if="filter.descricao">
							<div class="chip">
								Descrição: {{filter.descricao}}
								<i class="close material-icons" ng-click="limparItemFiltro('descricao')">close</i>
							</div>
						</div>
						<div ng-if="filter.minValor && filter.maxValor">
							<div class="chip">
								Preço: {{filter.minValor}} até {{filter.maxValor}}
								<i class="close material-icons" ng-click="limparItemFiltro('valor')">close</i>
							</div>
						</div>
						<div ng-if="filter.minEstrela && filter.maxEstrela">
							<div class="chip">
								Estrelas: {{filter.minEstrela}} até {{filter.maxEstrela}}
								<i class="close material-icons" ng-click="limparItemFiltro('estrela')">close</i>
							</div>
						</div>
						<i ng-click="openOrder()" class="material-icons right">
							sort_by_alpha
						</i>		
						<i ng-click="openFilter()" class="material-icons right">
							filter_list
						</i>
					</div>
				</div>
			</div>
		</div>
	<div>
		<div 
			ng-repeat="servico in arrServicos" 
			after-load-services-directive>
	<div class="card small">
	    <div class="card-image waves-effect waves-block waves-light">
	      <img class="activator" 
				alt="{{servico.ds_categoria}}"
				ng-src="../includes/imagens/categorias/{{servico.url_img_categoria}}" 
				>
	    </div>
	    <div class="card-content">
	      <span class="card-title activator grey-text text-darken-4">
					{{servico.ds_servico}}
					<i class="material-icons right">
						visibility
					</i>
				</span>
	      <p class="right">R$ {{servico.valor}}</p>
				<div id="starbox" class="starbox" data-button-count="{{servico.qt_estrela}}"></div>
	    </div>
	    <div class="card-reveal">
	      <span 
					class="card-title grey-text text-darken-4">
					{{servico.nm_prestador}}
					<i class="material-icons right">
						close
					</i>
				</span>
					<div class="right"> 
						<img 
						width="128"
						class="materialboxed responsive-img circle"
						data-ng-src="../includes/imagens/fotos_pessoas/{{servico.imagem_pessoa}}"
						alt="{{servico.nm_prestador}}"		
						> 
					</div>
						<p>
							{{servico.ds_categoria}} <br/>
							{{servico.qt_servico}} pessoas atendidas.<br/>
							Preço: R$ {{servico.valor}} <br/>
							Avaliação:
						</p>
						<div id="starbox" class="starbox" data-button-count="{{servico.qt_estrela}}"></div>
						<button 
							ng-click="goToDetail(servico.id_servico)"
							class="btn right">Solicitar
						</button>
	    </div>
  	</div>
</div>	
		  <!-- Modal Structure -->
  	<div  id="modalDetalheServico" class="modal">
	    <div class="modal-content">
	      <h5 class="modal-title center" id="modalDetalheServicoLabel">Solicitação de serviços</h5>
	      <?php
	      		$this->load->view('DetalheServico.php');
	      	?> 	
		</div>
  	</div>

	<div id="modalFilterOrder" ng-class='isFilter ? "modal modal-fixed-footer" : "modal"'>
  		<?php
      		$this->load->view('FiltrarOrdenarServicoCliente.php');
      	?>
  	</div>

	</div>
	<?php
		// Importa o cabeçalho rodape padrao a todas as telas
		$this->load->view('nucleo/footer.php');
	?>

	 <!-- <script type="text/javascript" src="https://raw.githubusercontent.com/Dogfalo/materialize/9bc43a1199ad5dfb78d58ba47726ab039218a939/dist/js/materialize.min.js"></script>  -->
	<!-- <script type="text/javascript" src="http://next.materializecss.com/bin/materialize.js"></script>    -->
	<!-- <script type="text/javascript" src="https://raw.githubusercontent.com/Dogfalo/materialize/v0.100.2/dist/js/materialize.min.js"></script> -->
<!-- 	<script type="text/javascript" src="../includes/js/locales/bootstrap-datepicker.pt-BR.min.js"></script> -->
	<script type="text/javascript" src="../includes/js/ServicoClienteDetalhe.service.js"></script>
	<script type="text/javascript" src="../includes/js/ConsultaServicoCliente.controller.js"></script>
	<script type="text/javascript" src="../includes/js/DetalheServico.js"></script>
	<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
</body>
</html>