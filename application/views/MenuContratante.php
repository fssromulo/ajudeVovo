<header>
   <div class="navbar-fixed">
      <nav>
       <div class="nav-wrapper blue #1889ff">
         <a href="#!" class="align-left" style="font-size:23px; color:white !important; " >
           <?php echo $titulo_tela ?>
         </a>
         <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
         <ul class="right hide-on-med-and-down">
            <li>
                <a href="#perfil_implementar">Perfil</a>
            </li>
            <li>
               <a href="../ConsultaServicoCliente/">Serviços</a>
            </li>
            <li>
               <a href="../ControleSolicitante/">Serviços solicitados</a>
            </li>
            <li>
              <a href="../Login/sairSistema">Sair</a>
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
       <a href="#!user"><img alt="<?php echo $this->session->userdata('nome');?>"  class="circle" src="<?php echo $this->session->userdata('DIR_FOTOS_PESSOAS'); echo $this->session->userdata('imagem_pessoa');?>"></a>
       <a href="#!name"><span class="white-text name"><?php echo $this->session->userdata('nome');?></span></a>
       <a href="#!email"><span class="white-text email"><?php echo $this->session->userdata('login');?></span></a>
       </div>
     </li>
     <li><a href="#perfil_implementar"><i class="material-icons">face</i>Perfil</a></li>
     <li><a href="../ConsultaServicoCliente/"><i class="material-icons">room_service</i>Serviços</a></li>
     <li><a href="../ControleSolicitante/"><i class="material-icons">history</i>Serviços solicitados</a></li>
     <li><a href="../Login/sairSistema"><i class="material-icons">rowing</i>Sair</a></li>
   </ul>

</header>
<div class="row"><div class="col-sm-12">&nbsp;</div></div>