<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>   
</head>
<body>
    <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('MenuPrestador.php');
    ?>
    <div ng-app="appAngular" ng-controller="controllerControlePrestador">  

    <input type="hidden" ng-model="is_contratante" name="is_contratante" ng-init="is_contratante=1" />
    <div class="container">
         <ul  class="collapsible" data-collapsible="accordion"  >
            <li ng-repeat="lista in arrListaServico">
                <div class="collapsible-header" >
                    
                    <img alt="" data-ng-src="../includes/imagens/fotos_pessoas/{{lista.imagem_pessoa}}" class="circle " width="50" height="50"> &nbsp;
                    <!--<div class="col s6 col m6 flow-text" >-->
                        <p class="truncate">{{lista.descricao}}</p> 
                        <div class="right-align">
                            <span ng-show="lista.ativo != 1" class="new badge red right-align" data-badge-caption="">
                                Inativo
                            </span>
                        </div>
                    <!--</div>-->
                </div>
                <div class="collapsible-body" > 
                    Serviço:{{lista.descricao}}<br/>
                    Idoso:{{lista.nome}} <br/>
                    Data/Horário:
                        {{lista.dia_solicitacao}} - {{lista.horario_inicio}}&nbsp;até&nbsp;{{lista.horario_fim}} <br/>
                    Situação:  {{lista.ds_estado_atual}} <br/>


                        <div ng-show="{{lista.id_estado_operacao}} == 3">
                           
                            <button 
                                title="Negar"
                                ng-click="negar(lista.id_servico)"
                                class="waves-effect waves-light btn red darken-1"
                                style="font-size: 16px;">
                                    <span class="thumbs-up" >
                                        <i class="material-icons">thumb_down</i>
                                    </span>
                            </button>

                            <a 
                                title="Aceitar" 
                                ng-click="aceitar(lista.id_servico)"
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
                                ng-click="abrirTelaAvaliacao(lista.id_servico_solicitacao)"
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