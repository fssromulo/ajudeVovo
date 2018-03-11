<?php
		// Importa o cabeçalho padrao a todas as telas
		$this->load->view('nucleo/header.php');
?>

</head>
<body>
	<div data-ng-app="AppHome" data-ng-controller="controllerHome">

	<header>
	  <div class="navbar-fixed">
	    <nav class="white" role="navigation">
	    <div class="nav-wrapper container">
	      
	      <a href="#" data-activates="nav-mobile" class="button-collapse menus_iniciais"><i class="material-icons">menu</i></a>
	      <ul class="right hide-on-med-and-down">
	        <li><a href="#quemSomos">Sobre Nós</a></li>
	        <li><a href="../perfil/">Login</a></li>
	      </ul>
	    </div>
	  </nav>
	  </div>

	  <ul id="nav-mobile" class="side-nav white">
	    <li><a href="#">Sobre nós</a></li>
	    <li><a href="../perfil/">Login</a></li>
	  </ul>
	</header>

		<div class="container">

			<div class="center">

					<div class="row">

						<div class="col s12 m12 l12"> <!-- Note that "m8 l9" was added -->     
							<div class="row">&nbsp;</div>
							<div class="row">
								<div class="col s12">
									<button
									onclick="location.href='../Logar/?ajudante'"
									class="waves-effect btn btn-large col s12 teal lighten-1"><i class="material-icons left">person_add</i><strong>Sou um ajudante</strong></button>
								</div>
							</div>
							<div class="row">
								<div class="col s12">              
									<button
										onclick="location.href='../Logar/?contratante'"
										class="waves-effect btn btn-large col s12 teal lighten-1">
										<i class="material-icons left">group_add</i>
										<strong>Sou um vovô</strong>
									</button>
								</div>
							</div>
						</div>
					</div>        
			</div>
		</div>
	</div>


	<script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>
	<?php
	// Importa o cabeçalho rodape padrao a todas as telas
	$this->load->view('nucleo/footer.php');
	?> 
	<script type="text/javascript" src="../includes/js/home.js?<?php echo date('YmdHis');?>"></script>
</body>
</html>