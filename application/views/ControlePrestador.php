<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>   
</head>
<body>
    <div ng-app="appAngular" ng-controller="controllerControlePrestador">  
    <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('MenuPrestador.php');
    ?>

    <div>
        <p ng-show="arrListaServico.length < 1" style="font-size: 20px; text-align: center;">Você ainda não possui serviços solicitados!</p>
    </div>
    <input type="hidden" ng-model="is_contratante" name="is_contratante" ng-init="is_contratante=1" />
    <div class="container">
         <ul  class="collapsible" data-collapsible="accordion" >
            <li ng-repeat="lista in arrListaServico" after-load-services-directive>
                <div class="collapsible-header" >
                    
                    <img alt="" data-ng-src="../includes/imagens/fotos_pessoas/{{lista.imagem_pessoa}}" class="circle " width="50" height="50"> &nbsp;
                        <p class="truncate">{{lista.descricao}}</p> 
                        <div class="right-align">
                            <span ng-show="lista.ativo != 1" class="new badge red right-align" data-badge-caption="">
                                Inativo
                            </span>
                        </div>
                </div>
                <div class="collapsible-body" > 
                    Serviço:{{lista.descricao}}<br/>
                    Idoso:{{lista.nome}} <br/>
                    Data/Horário:
                        {{lista.dia_solicitacao}} - {{lista.horario_inicio}}&nbsp;até&nbsp;{{lista.horario_fim}} <br/>
                    Situação:  {{lista.ds_estado_atual}} <br/>
                    <strong>Necess. Especiais: {{lista.necessidades_especiais}}</strong> <br/>
                    Avaliação: <br/>
                    <div id="starbox" class="starbox" data-button-count="{{lista.qt_estrela}}"></div>

                        <div ng-show="{{lista.id_estado_operacao}} == 3">
                           
                            <button 
                                title="Negar"
                                ng-click="negarServico(lista.id_servico_solicitacao)"
                                class="waves-effect waves-light btn red darken-1"
                                style="font-size: 16px;">
                                    <span class="thumbs-up" >
                                        <i class="material-icons">thumb_down</i>
                                    </span>
                            </button>

                            <a 
                                title="Aceitar" 
                                ng-click="aceitarServico(lista.id_servico_solicitacao)"
                                class="waves-effect waves-light btn light darken-1"
                                style="font-size: 16px;">
                                <span class="thumbs-up" >
                                    <i class="material-icons">thumb_up</i>
                                </span>
                            </a>
                        </div>
                        
                        <div ng-show="{{lista.id_estado_operacao}} == 4">
                            <button 
                                title="Finalizar Serviço" 
                                ng-click="abrirTelaAvaliacao(lista)"
                                class="waves-effect waves-light btn light darken-1"
                                style="font-size: 14px;">Finalizar Serviço
                                    <span class="material-icons">check</span>
                            </button>
                        </div>                
                    </div>
                </li>            
            </ul>
        </div>

           <!-- Modal Structure -->
          <div id="modalAvaliacao" class="modal modal-fixed-footer">
            <div class="modal-content">
              <h4>Realizar avaliação </h4>
                  <?php
                $this->load->view('Avaliacao.php');?> 
            </div>
          </div>
    </div>

    <script type="text/javascript"  src="../includes/jQuery/jquery.js"></script>    
    <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?>
    <script type="text/javascript" src="../includes/js/RealizarAvaliacao.service.js"></script>
    <script type="text/javascript" src="../includes/js/ConsultaControlePrestador.js"></script>
    <script type="text/javascript" src="../includes/js/Avaliacao.controller.js"></script>
    <script type="text/javascript" src="../includes/js/MenuPrestador.controller.js"></script>
</body>
</html>