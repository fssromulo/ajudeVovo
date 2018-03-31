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
   <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('MenuAdministracao.php');
    ?>

  <div class="user-view">
    <div ng-app="appAngular" ng-controller="ctrlAdmSelecaoAjudante">
      
      <div class="container">
           <ul  class="collapsible" data-collapsible="accordion"  >
              <li ng-repeat="lista in arrlistaPessoas">
                  <div class="collapsible-header" >
                      <!--<i class="large material-icons">-->
                          <img src="{{lista.imagem_pessoa}}" class="circle " width="50" height="50">
                      <!--</i>-->
                          <p class="truncate"> {{lista.nome}}</p>
                          <span ng-show="lista.ativo != 1" class="new badge red right" data-badge-caption="" >
                                  Inativo! 
                          </span>
                  
                       
                  </div>
                  <div class="collapsible-body" > 
                       
                      Nome:{{lista.nome}}<br/>
                      Data de Nascimento:{{lista.dt_nascimento}} <br/>
                      CPF:{{lista.cpf}} <br/>
                      Situação: {{lista.situacao}} <br/>

                      <button 
                        title="Negar"
                        ng-click="negar(lista.id_pessoa_fisica)"
                        class="waves-effect waves-light btn red darken-1"
                        style="font-size: 16px;">
                            <span class="thumbs-up" >
                                <i class="material-icons">thumb_down</i>
                            </span>
                      </button>

                     <button 
                      title="Aceitar" 
                      ng-click="aceitar(lista.id_pessoa_fisica)"
                      class="waves-effect waves-light btn light darken-1"
                      style="font-size: 16px;">
                      <span class="thumbs-up" >
                        <i class="material-icons">thumb_up</i>
                      </button>
                    </a>
                  </div>
              </li>
              
          </ul>
      </div>
    </div>
  </div>  


  <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 

    <script type="text/javascript" src="../includes/js/AdministracaoSelecaoAjudante.js"></script>

  </body>
</html>