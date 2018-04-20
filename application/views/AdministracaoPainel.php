<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>
</head>
<body>
  
    <?php
      // Importa o cabeçalho padrao a todas as telas
    $this->load->view('MenuAdministracao.php')?>
  

    

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