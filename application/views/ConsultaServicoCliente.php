<html lang="pt_BR">
<head>
	<title>Opa! Ajude o Vovô</title>
	<!-- jQuery & Bootstrap -->

	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../includes/star-rating/css/star-rating.min.css" media="all" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="../includes/star-rating/js/star-rating.min.js" type="text/javascript"></script>
	
	<style>
	/*
	* Start Bootstrap - Heroic Features (http://startbootstrap.com/)
	* Copyright 2013-2016 Start Bootstrap
	* Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
	*/

	.hero-spacer {
		margin-top: 50px;
	}

	.hero-feature {
		margin-bottom: 30px;
	}

	footer {
		margin: 50px 0;
	}

	header h1 {
		font-size: 32px;
		line-height: 1.5;
		color: #000000;
	}

	.header-image {
		display: block;
		text-align: center;
		background: url('../imagens/background.png') no-repeat center center scroll;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		background-size: cover;
		-o-background-size: cover;
	}

	.headline {
		padding: 120px 0;
	}

	.novas-cards {
		border-radius: 10px;
		background-color: #ffffff;
		text-align: center;
		box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.1);
	}

	.novas-fotos {
		object-fit: contain;
		/*
		border-radius: 100px;
		*/
	}

	.novo-botao_contratar {
		border-radius: 7px;
		background-color: #1889ff;
		box-shadow: 0 5px 15px 0 rgba(24, 137, 255, 0.45);
	}

	.stars-5 {
		width: 68px;
		height: 9px;
		object-fit: contain;
	}

	.pessoas-atendidas {
	font-size: 10px;
	text-align: right;
	color: #a3a3a3;
	
	}

	.btn-contratar {
	border-radius: 7px;
	background-color: #1889ff;
	box-shadow: 0 5px 15px 0 rgba(24, 137, 255, 0.45);
	}

	.price {
	font-family: Roboto;
	font-size: 28px;
	color: #1889ff;
	}

	.navbar{
	display:none !important;	
	}
	</style>
</head>

<body ng-app="appAngular" ng-controller="controllerAngular">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<input
							 id="nota"
							 name="nota" 
							 class="kv-fa-heart rating-loading"
							 data-min="0" 
							 data-max="5" 
							 data-step="1" 
							 data-size="xs"
							 value="3"
							 ng-model="nota">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<label for="pesquisa">Pesquise:</label>
						<input
							type="text" 
							ng-model="pesquisa" 
							class="form-control" 
							id="contratante" 
							placeholder="Insira o nome do serviço ou categoria desejada...">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 hero-feature" ng-repeat="servico in arrServicos | filter:pesquisa ">
			<div class="thumbnail text-center novas-cards">
				<img 
					class="novas-fotos" 
					ng-src="{{servico.url_img_categoria}}" 
					alt="{{servico.ds_categoria}}"> 
				<div class="caption">
					<h3>{{servico.ds_categoria}}</h3>
					<p>{{servico.nm_prestador}}</p>
					<div>
						<input
								id="nota"
								name="nota" 
								class="kv-fa-heart rating-loading"
								data-min="0" 
								data-max="5" 
								data-step="1" 
								data-size="xs"
								value="3"
								ng-model="nota">
						<p class="pessoas-atendidas pull-right">{{servico.qt_servico}} pessoas atendidas</p>
					</div>
					<br>
					<p></p>
					<p>
						{{servico.ds_detalhe}}
					</p>
					<p class="price">R$ {{servico.valor}}</p>
					<p>
						<a 
						href="detalhe_servico.php" 
						class="btn btn-primary btn-contratar">Mais informações</a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).on('ready', function () {
			$('.kv-fa-heart').rating({
				theme: 'krajee-fa',
				filledStar: '<i class="fa fa-heart"></i>',
				emptyStar: '<i class="fa fa-heart-o"></i>',
				clearCaption: '',
				starCaptions: {1: ' ', 2: ' ', 3: ' ', 4: ' ', 5: ' '},
				disabled: true, showClear: false,
				starCaptionClasses: {1: 'text-info', 2: 'text-info', 3: 'text-info', 4: 'text-info', 5: 'text-info'}
			});
		});
	</script>

	<!-- Angular JS -->
	<script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

	<link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
	<script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/ConsultaServicoCliente.controller.js"></script>
</body>
</html>