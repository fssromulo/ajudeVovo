<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

  <!-- CSS  -->
<!--   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->


</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Cadastrar Categorias</a></li>
        <li><a href="#">Aprovação e Reprovação de Ajudantes</a></li>
        <li><a href="#">perfil de usuário</a></li>
        <li><a href="#">necessidades especiais</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Sobre nós</a></li>
        <li><a href="../perfil/">Login</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

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
  </body>
</html>