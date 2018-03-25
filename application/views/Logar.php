<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

</head>
<body>
    <div data-ng-app="AppHome" data-ng-controller="controllerHome">
    <div class="container">
            <div class="center row" >
                <input type="hidden" ng-model="is_ajudante" name="is_ajudante" ng-init="is_ajudante=<?php echo $ajudante;?>" />

                <input type="hidden" ng-model="is_contratante" name="is_contratante" ng-init="is_contratante=<?php echo $contratante;?>" />

                    <div class="center col s12 m7 offset-m3 l7 offset-l3"> 
                        <div id="frm_login">
                           <div class="row">
                            <div class="row"> &nbsp;</div>
                            <form class="center col s12">
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
                                        type="text"
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
                                        <div class="left-align  col s12">
                                          <a class="left-align" href="#" data-ng-click="novoCadastro()">Novo por aqui? Cadastre-se!</a>
                                        </div>
                                  </div>
                                  <!-- <div class="row"> -->
                                    <div class="col s12 center-align">

                                    <div class="col s6">
                                      <a 
                                        class="waves-effect waves-light btn red darken-1 col s12" href="../home/"><i class="material-icons left">arrow_back</i>Voltar</a>
                                      </div>
                                    <div class="col s6">
                                      <button
                                       type="submit"
                                       data-ng-click="fazerLogin()"
                                       class="waves-effect waves-light btn light-blue darken-2 col s12">
                                          <i class="material-icons right">arrow_forward</i>Entrar</button>
                                      </div>
                                    </div>
                                  <!-- </div> -->
                            </form>
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
