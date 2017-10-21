<!DOCTYPE html>
<html lang="pt_BR">
<head>
	<title>CodeIgniter & AngularJS</title>
	<!-- jQuery & Bootstrap -->
	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
</head>

<body ng-app="appAngular2" >

	<div
		class="container-fluid"
		ng-controller="controllerAngular2">

		teste

		<div class="row">
			<div class="col-md-3">
				<button
					class="btn btn-success"
					name="btn_pagseguro"
					id="btn_pagseguro"
					ng-click="realizaPagamentoPagSeguro()"
				>Enviar PagSeguro !!</button>
			</div>
		</div>
	</div>


	<script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>

	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

	<!-- Angular JS -->
	<script type="text/javascript" src="../includes/angular/angular.js"></script>  

	<script type="text/javascript" src="../includes/js/pagseguro.js?<?php echo date('YmdHis');?>"></script>

	<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
</body>
</html>