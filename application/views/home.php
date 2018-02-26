<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

</head>
<body class="blue-grey lighten-4">
    <div data-ng-app="AppHome" data-ng-controller="controllerHome">
    <div class="container">
        <!-- Navigation -->
<!--         <nav>
            <div class="nav-wrapper blue #1889ff">
              <a href="#!" class="brand-logo"><img src="../includes/imagens/pwa_icons/android-chrome-48x48.png"/></a>
              <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <li><a href="#">Home</a></li>
                <li><a href="#">Quero ajudar</a></li>
                <li><a href="#">Solicitar ajuda</a></li>
              </ul>
                  <ul id="mobile-demo" class="side-nav">
                    <li><div class="user-view">
                      <div class="background blue #1889ff">
                        <div class="blue lighten-1"></div>
                      </div>
                      <a href="#!user"><img class="circle" src="../includes/imagens/pwa_icons/android-chrome-192x192.png"></a>
                      <a href="#!name"><span class="white-text name">Adalberto Azevedo</span></a>
                      <a href="#!email"><span class="white-text email">ajudevovo@gmail.com</span></a>
                    </div></li>
                    <li><a href="#" id="link_frm_login" ><i class="material-icons">home</i>Home</a></li>
                    
                    <li><a href="#"><i class="material-icons">power_settings_new</i>Sair</a></li>
                  </ul>
            </div>
        </nav> -->

            <div class="center row" >
                    <div class="center col s12 m8 offset-m4 l9 offset-l3"> <!-- Note that "m8 l9" was added -->     

                        <div id="frm_login">
                           <div class="row">
                            <div class="row"> &nbsp;</div>
                            <form class="center col s12 m8 l8">
                                <div class="">
                                    <img
                                        class=" center-align responsive-img" 
                                        src="../includes/imagens/logo_login.png"
                                        alt="logo_ajude_vovo"
                                    />
                                    <br/>
                                </div>

                                  <div class="row">
                                    <div class="input-field col s12">
                                      <input
                                        value=""
                                        type="email"
                                        class="validate" 
                                        data-ng-model="usuario_logar"/>
                                      <label for="disabled">Usuário/E-mail</label>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="input-field col s12">
                                      <input
                                        id="password"
                                        type="password"
                                        class="validate"
                                        data-ng-model="senha_logar"
                                      />
                                      <label for="password">Senha</label>
                                    </div>
                                  </div>
                                  <div class="row">
                                        <div class=" left-align  col s12">
                                          <a class="left-align" href="#">Novo por aqui? Cadastre-se!</a>
                                        </div>
                                  </div>
                                  <div class="row">
                                    <div class="input-field col s12 ">
                                      <a class="waves-effect waves-light btn right  light-blue darken-2">Entrar</a>
                                    </div>
                                  </div>
                            </form>
                          </div>
                        </div>

                    </div>
              </div>

        <!-- nav class="navbar navbar-inverse navbar-fixed-top bg-ajudeVovo" role="navigation">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menuResponsivo">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">Ajude o vovô</a>
                </div>

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
    		             	data-ng-click="escolherPerfil('ajudante')"
    			             >Quero Ajudar</a>
                    	</li>


                        <li>
    						<a href="#" popover
    							data-placement="bottom"
    							data-toggle="popover2"
    							data-title="Efetue o login"                                         
    							data-container="body"
    		             	    data-html="true" id="login"
    		             	    class="links_menu"
    		             	    data-ng-click="escolherPerfil('contratante')"
    				        >Solicitar ajuda</a>
                        </li>
                    </ul>
                </div>
               
            </div>

        </nav> 

        <div id="popLoginPessoa" class="hide">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                    <input type="text" placeholder="Usuário" data-ng-model="usuario_logar" class="form-control" maxlength="15"><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="password" placeholder="Senha" data-ng-model="senha_logar" class="form-control"><br/>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" data-ng-click="cancelar()" class="btn btn-danger">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary" data-ng-click="fazerLogin()">
                            Login
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="left-align col-sm-12">
                        <a
                        href="{{link_cadastro}}"
                        class="left-align">Novo por aqui? Cadastre-se!</a>
                        <br/>
                    </div>
                </div>                
            </div>
        </div>
    -->
        
    </div>
    </div>
    <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>

<!-- 

	<script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  


	<script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

	<link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
	<script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>
 -->
    <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 


	<script type="text/javascript" src="../includes/js/home.js?<?php echo date('YmdHis');?>"></script>
</body>

</html>
