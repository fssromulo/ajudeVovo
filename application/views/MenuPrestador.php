<div ng-controller="controllerMenu">
  <header>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper blue #1889ff">
           <a href="#!" class="brand-logo" style="font-size:18px; color:white !important; " >
             <?php echo $titulo_tela ?>
           </a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li>
                  <a href="#perfil_implementar">Perfil</a>
              </li>
              <li>
                  <a href="../ListarServico/">Meus serviços</a>
              </li>
              <li>
                  <a href="../ControlePrestador/">Serviços solicitados</a>
              </li>
              <li>
                <a href="../Login/sairSistema">Sair</a>
              </li>
              <li>
                  <a ng-show="podeExcluirContaRetorno" id="delete_foreverx">Excluir minha conta</a>
              </li>
            </ul>

          </div>
        </nav>
      </div>
      <ul id="mobile-demo" class="side-nav">
        <li>
          <div class="user-view">
          <div class="background blue #1889ff">
            <div class="blue lighten-1"></div>
          </div>
          <a href="#!user"><img class="circle" src="../includes/imagens/pwa_icons/android-chrome-192x192.png"></a>
          <a href="#!name"><span class="white-text name">Adalberto Azevedo</span></a>
          <a href="#!email"><span class="white-text email">ajudevovo@gmail.com</span></a>
          </div>
        </li>
        <li><a href="#perfil_implementar"><i class="material-icons">face</i>Perfil</a></li>
        <li><a href="../ListarServico/"><i class="material-icons">room_service</i>Meus serviços</a></li>
        <li><a href="../ControlePrestador/"><i class="material-icons">history</i>Serviços solicitados</a></li>
        <li><a href="../Login/sairSistema"><i class="material-icons">rowing</i>Sair</a></li>
        <li><a ng-show="podeExcluirContaRetorno" id="delete_forever"><i class="material-icons">delete_forever</i>Excluir minha conta</a></li>
      </ul>
  </header>

  <div class="row"><div class="col-sm-12">&nbsp;</div></div>

  <div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="gridSystemModalLabel">Tem certeza que deseja excluir sua conta?</h4>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-success" ng-click="excluir()">Sim</button>
                  <button type="button" class="btn btn-danger" ng-click="fechar()">Não</button>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</div>