<html lang="pt_BR">
<head>
	<title>Opa! Ajude o Vovô</title>
	<!-- jQuery & Bootstrap -->

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../includes/star-rating/css/star-rating.min.css" media="all" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="../includes/star-rating/js/star-rating.min.js" type="text/javascript"></script>	
</head>

<body>
	<div
		class="container"
		ng-app="appAngular"
		ng-controller="controllerAvaliacao"
	>
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<label for="nota">Nota:</label>
						<input
							id="nota"
							name="nota" 
							class="kv-fa-heart rating-loading"
							data-min="0" 
							data-max="5" 
							data-step="1" 
							data-size="md"
							ng-value="0"
							ng-model="nota">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<label for="comentario">Comentário:</label>
						<textarea ng-model="comentario" class="form-control" id="comentario" placeholder="Comentário...">
						</textarea>
					</div>
				</div>
			</div>
		</div>   
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<label for="contratante">Contratante:</label>
						<input type="text" ng-model="contratante" class="form-control" id="contratante" placeholder="valor que deve ser passado por background, esse campo não deve estar em tela" />
					</div>
				</div>
			</div>
		</div>   
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<label for="servico">Serviço:</label>
						<input type="text" ng-model="servico" class="form-control" id="servico" placeholder="valor que deve ser passado por background, esse campo não deve estar em tela" />
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
					<button type="button" ng-click="cancelar()" class="btn btn-danger">
						Cancelar
					</button>
				</div>
			</div>
		</div>
		<br/>
	</div>

	<script>
		$(document).on('ready', function () {
			$('.kv-fa-heart').rating({
				theme: 'krajee-fa',
				filledStar: '<i class="fa fa-heart"></i>',
				emptyStar: '<i class="fa fa-heart-o"></i>',
				clearButtonTitle: 'Limpar',
				clearCaption: '',
				starCaptions: {1: ' ', 2: ' ', 3: ' ', 4: ' ', 5: ' '},
				//showClear: false, disabled: true,
				starCaptionClasses: {1: 'text-info', 2: 'text-info', 3: 'text-info', 4: 'text-info', 5: 'text-info'}
			});
			$('.kv-fa').rating({
				theme: 'krajee-fa',
				filledStar: '<i class="fa fa-star"></i>',
				emptyStar: '<i class="fa fa-star-o"></i>',
				clearButtonTitle: 'Limpar',
        		clearCaption: 'Não avaliado'
			});
		});
	</script>

	<!-- Angular JS -->
	<script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

	<link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
	<script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

	<!-- MY App -->
	<script type="text/javascript" src="../includes/js/Avaliacao.controller.js"></script>
</body>
</html>