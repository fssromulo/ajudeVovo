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
          <li><a href="../AdministracaoCadastroCategorias/">Cadastro de Categorias</a></li>
          <li><a href="#">Aprovação ou Reprovação de Ajudantes</a></li>
          <li><a href="">Cadastro de perfil de usuário</a></li>
          <li><a href="#">Cadastro de necessidades especiais do vovo ou ajudante</a></li>
        </ul>
      </div>
    </nav>
    </div>

    <ul id="nav-mobile" class="side-nav white">
      <li><a href="../AdministracaoCadastroCategorias/">Cadastro de Categorias</a></li>
          <li><a href="#">Aprovação ou Reprovação de Ajudantes</a></li>
          <li><a href="">Cadastro de perfil de usuário</a></li>
          <li><a href="#">Cadastro de necessidades especiais do vovo ou ajudante</a></li>
    </ul>
  </header>
  <?php
      // Importa o cabeçalho rodape padrao a todas as telas
      $this->load->view('nucleo/footer.php');
    ?>
    <script type="text/javascript">
        $( document ).ready(function() {
          $('.button-collapse').sideNav();
          $('.parallax').parallax();
        });
    </script>

     <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 
  </body>
</html>