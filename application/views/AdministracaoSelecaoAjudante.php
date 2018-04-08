<?php
  // Importa o cabeçalho padrao a todas as telas
  $this->load->view('nucleo/header.php');
?>
</head>
<body>
 <?php
      // Importa o cabeçalho padrao a todas as telas
      $this->load->view('MenuAdministracao.php');?>
  <div class="user-view">
    <div ng-app="appAngular" ng-controller="ctrlAdmSelecaoAjudante">
      
      <div class="container">
           <ul  class="collapsible" data-collapsible="accordion"  >
              <li ng-repeat="lista in arrlistaPessoas">
                  <div class="collapsible-header" >

                     
                          <img alt="" src="../includes/imagens/fotos_pessoas/{{lista.imagem_pessoa}}" class="circle " width="50" height="50">&nbsp;
                    
                          <p class="truncate"> {{lista.nome}}</p>
                  </div>
                  <div class="collapsible-body" >                        
                      Nome:{{lista.nome}}<br/>
                      Data de Nascimento:{{lista.dt_nascimento}} <br/>
                      CPF:{{lista.cpf}} <br/>
                      Sexo: {{lista.sexo}} <br/>
                      Nome do pai: {{lista.nome_pai}} <br/>
                      Nome da mãe: {{lista.nome_mae}} <br/>
                      imagem do documento (Frente): {{lista.imagem_frente_documento}} <br/>
                      imagem do documento (Verso): {{lista.imagem_verso_documento}} <br/>
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
    $this->load->view('nucleo/footer.php');?> 
    <script type="text/javascript" src="../includes/js/AdministracaoSelecaoAjudante.js"></script>
  </body>
</html>