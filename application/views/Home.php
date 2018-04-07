<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

</head>
<body>
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

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Ajude o Vovô</h1>
        <div class="row center">
          <h5 class="header col s12 light">Ajude um idoso ou seja ajudado!</h5>
        </div>
        <div class="row center">
          <a href="../perfil/" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Começar</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img alt="ajude o vovo" src="../includes/imagens/inicial/maos.png" alt="maos"></div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">important_devices</i></h2>
            <h5 class="center" id="quemSomos">Quem somos</h5>

            <p class="light">somos uma equipe que se preocupa com o bem estar de idosos que precisam de alguma ajuda e não tem a quem recorrer.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">favorite_border</i></h2>
            <h5 class="center">Nosso objetivo</h5>

            <p class="light">Nós queremos aproximar quem precisa de ajuda com quem tem vontade de ajudar ou que disponibiliza algum serviço doméstico pago.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Como funciona?</h5>

            <p class="light">Idosos e jovens podem se cadastrar! Se você quer ser um ajudante, basta se cadastrar e entraremos em contato com você, pois para melhor segurança, seus dados passarão por uma análise antes de confirmarmos o seu cadastro. Cadastre-se e venha fazer parte desse time!</p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
         <h5 class="white-text">Venha fazer parte desse time!</h5>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Redes sociais</h5>
          <ul>
            <li>
              <a class="white-text" href="https://www.facebook.com/ajudeOvovo/">@AjudeOvovo
               <img src="../includes/imagens/icon-facebook.png" width="50px">
              </a>
            </li>
            <li>
              <a class="white-text" href="https://www.instagram.com/?hl=pt-br">@Ajudeovovo
                <img src="../includes/imagens/icon-instagram.png" width="60">
                
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container center">
        © <?php echo date('Y') ?> Ajude o vovô, Todos os direitos reservados.
      </div>
    </div>
  </footer>
  <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?>
  </body>
</html>