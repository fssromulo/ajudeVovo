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
<div>
		<div 
			ng-repeat="servico in arrServicos | filter:pesquisa " 
			after-load-services-directive>


	<!-- <div class="material-placeholder">
		<img class="materialboxed" width="650" 
						src="https://cdn2.iconfinder.com/data/icons/lil-faces/233/lil-face-4-512.png"
	></div> -->

	<div class="card small">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" 
			alt="{{servico.ds_categoria}}"
			ng-src="{{servico.url_img_categoria}}" 
			>
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">
				{{servico.ds_categoria}}
				<i class="material-icons right">
					visibility
				</i>
			</span>
      <p class="right">R$ {{servico.valor}}</p>
			<div id="starbox" class="starbox" data-button-count="{{servico.qt_estrela}}"></div>
    </div>
    <div class="card-reveal container valign-wrapper">
      <span 
				class="card-title grey-text text-darken-4">
				{{servico.ds_categoria}}
				<i class="material-icons right">
					close
				</i>
			</span>
			<!-- materialboxed class="materialboxed responsive-img" width="650"  -->
			<!-- ng-src="{{servico.url_img_categoria}}"  
			user-avatar-->
				<div class="user-avatar-container right"> 
					<img 
					class="user-avatar materialboxed responsive-img"
					src="https://cdn4.iconfinder.com/data/icons/smileys-for-fun/128/smiley__3-128.png"
					alt="{{servico.ds_categoria}}"						
					> 
				</div>
					<p>
						Ajudante: {{servico.nm_prestador}} <br/>
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
		      <h4 class="modal-title" id="modalDetalheServicoLabel">Solicitação de serviços</h4>
		      <?php
		      		$this->load->view('DetalheServico.php');
		      	?> 	
		    </div>
		  </div>
	</div>

	  
	<?php
		// Importa o cabeçalho rodape padrao a todas as telas
		$this->load->view('nucleo/footer.php');
	?>


	<script type="text/javascript" src="../includes/js/locales/bootstrap-datepicker.pt-BR.min.js"></script>
	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/ServicoClienteDetalhe.service.js"></script>
	<script type="text/javascript" src="../includes/js/ConsultaServicoCliente.controller.js"></script>
	<script type="text/javascript" src="../includes/js/DetalheServico.js"></script>

	<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
</body>
</html>