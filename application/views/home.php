<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ajude o vovo</title>
	<link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
	<link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
    <link href="../includes/css/pagina_inicial/pagina_inicial.css" rel="stylesheet">
</head>

<body>
    <div ng-app="AppHome" ng-controller="controllerHome">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menuResponsivo">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">Ajude o vovô</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="menuResponsivo" >
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#about">Home</a>
                        </li>
                       
    				    <li>
               			  <a
                             href="#"  
                            popover
               				data-placement="bottom"
               				data-toggle="popover"
               				data-title="Efetue o login"
               				data-container="body"
    		             	data-html="true"
    		             	id="login"
    		             	class="links_menu"
    		             	ng-click="escolherPerfil('ajudante')"
    			             >Quero Ajudar</a>
                    	</li>


                        <li>
    								<a href="#" popover
    									data-placement="bottom"
    									data-toggle="popover"
    									data-title="Efetue o login"
    									data-container="body"
    				             	data-html="true" id="login"
    				             	class="links_menu"
    				             	ng-click="escolherPerfil('contratante')"
    				             >Solicitar ajuda</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <div id="popLoginPessoa" class="hide">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                    <input type="text" placeholder="Usuário" ng-model="usuario_logar" class="form-control" maxlength="15"><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="password" placeholder="Senha" ng-model="senha_logar" class="form-control"><br/>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" ng-click="cancelar()" class="btn btn-danger">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="fazerLogin()">
                            Login
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a
                        href="{{link_cadastro}}"
                        class="link_cadastro">Novo por aqui? Cadastre-se!</a>
                        <br/>
                    </div>
                </div>                
            </div>
        </div>

        <!-- Full Width Image Header -->
        <header class="header-image">
            <div class="headline">
                <div class="container">
                    <h1>Ajude um vovô agora mesmo!</h1>
                    <h2>Junte-se a nós</h2>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="container">

            <hr class="featurette-divider">

            <!-- First Featurette -->
            <div class="featurette" id="about" >           
    		

            </div>

            <hr class="featurette-divider">

            <!-- Second Featurette -->
            <div class="featurette" id="services">
                <img class="featurette-image img-circle img-responsive pull-left" src="http://placehold.it/500x500">
                <h2 class="featurette-heading">The Second Heading
                    <span class="text-muted">Is Pretty Cool Too.</span>
                </h2>
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>

            <hr class="featurette-divider">

            <!-- Third Featurette -->
            <div class="featurette" id="contact">
                <img class="featurette-image img-circle img-responsive pull-right" src="http://placehold.it/500x500">
                <h2 class="featurette-heading">The Third Heading
                    <span class="text-muted">Will Seal the Deal.</span>
                </h2>
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>

            <hr class="featurette-divider">

        </div>
        <!-- /.container -->
    </div>

	<script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>

	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

	<!-- Angular JS -->
	<script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

	<link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
	<script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

	<script type="text/javascript" src="../includes/js/home.js?<?php echo date('YmdHis');?>"></script>
</body>

</html>
