<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>
</head>
<body>  
    <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('MenuContratante.php');
    ?>
  <div ng-app="appAngular" ng-controller="controllerDetalheServico">	
    <input type="hidden" ng-model="is_contratante" name="is_contratante" ng-init="is_contratante=1" />
    <div class="container">
         <ul  class="collapsible" data-collapsible="accordion"  >
            <li ng-repeat="lista in arrListaServico">
                <div class="collapsible-header" >
                    <img alt="" src="../includes/imagens/fotos_pessoas/{{lista.imagem_pessoa}}" class="circle " width="50" height="50"/>&nbsp;
                    <p class="truncate"> {{lista.servico}}</p>
                    <span ng-show="lista.ativo != 1" class="new badge red right" data-badge-caption="" >
                        Inativo! 
                    </span>
                </div>
                <div class="collapsible-body" > 
                     <span ng-show="lista.ativo != 1">
                        <strong>Este serviço está inativo!</strong>
                     </span><br/>
                    Serviço:{{lista.servico}}<br/>
                    Ajudante:{{lista.ajudante}} <br/>
                    Data/Horário:{{lista.dia}} - {{lista.horario_inicio}}&nbsp;até&nbsp;{{lista.horario_fim}} <br/>
                    Situação: {{lista.situacao}} <br/>

                    <div ng-show="{{lista.id_estado_operacao}} == 5">
                        <button 
                            title="Finalizar Serviço" 
                            ng-click="abrirTelaAvaliacao(lista.id_servico)"
                            class="waves-effect waves-light btn light darken-1"
                            style="font-size: 16px;"> Finalizar Serviço
                            <span class="material-icons">check</span>
                        </button>
                    </div>
                </div>
            </li>
            
        </ul>
    </div>
        <div class="modal fade" id="modalAvaliacao" tabindex="-1" role="dialog" aria-labelledby="modalAvaliacaoLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalAvaliacaoLabel">Realizar Avaliação </h4>
              </div>
              <div class="modal-body" >
                <?php
                    $this->load->view('Avaliacao.php');?>  
              </div>
            </div>
          </div>
        </div>
    </div>

   <!-- <script type="text/javascript" src="../includes/jQuery/jquery.js"></script>     -->
    <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 

    <script type="text/javascript" src="../includes/js/RealizarAvaliacao.service.js"></script>
    <script type="text/javascript" src="../includes/js/ConsultaControleSolicitante.js"></script>
    <script type="text/javascript" src="../includes/js/Avaliacao.controller.js"></script>
    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
</body>
</html>
