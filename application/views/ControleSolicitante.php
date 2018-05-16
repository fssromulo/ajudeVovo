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
    
    <p ng-show="arrListaServico.length < 1" style="font-size: 20px; text-align: center;">Você ainda não possui serviços solicitados!</p>

    <div class="container" ng-show="arrListaServico.length > 0">
        <ul  class="collapsible" data-collapsible="expandable">
            <li ng-repeat="lista in arrListaServico">
                <div class="collapsible-header" ng-click="openServiceClick($event)">
                    <img alt="" data-ng-src="../includes/imagens/fotos_pessoas/{{lista.imagem_pessoa}}" class="circle " width="50" height="50"/>&nbsp;
                    <p class="truncate"> {{lista.servico}}</p>
                    <span ng-show="lista.ativo != 1" class="new badge red" data-badge-caption="Inativo" style="margin: auto; margin-right: 10px; font-size: 14px; padding: 1px 5px 1px 5px"></span>
                </div>
                <div class="collapsible-body">
                     <span ng-show="lista.ativo != 1">
                        <strong>Este serviço está inativo!</strong>
                     </span><br/>
                    Serviço:{{lista.servico}}<br/>
                    Ajudante:{{lista.ajudante}} <br/>
                    Data/Horário:{{lista.dia}} - {{lista.horario_inicio}}&nbsp;até&nbsp;{{lista.horario_fim}} <br/>
                    Situação: {{lista.situacao}} <br/>
                    Valor: {{lista.valor}} <br/>
                    Avaliação média do ajudante: <br/>
                    <div id="starbox" class="starbox" data-button-count="{{lista.qt_estrela}}"></div>

                    <div ng-show="{{lista.id_estado_operacao}} == 5">
                        <button 
                            title="Finalizar Serviço" 
                            ng-click="abrirTelaAvaliacao(lista)"
                            class="waves-effect waves-light btn light darken-1"
                            style="font-size: 16px;"> Finalizar Serviço
                            <i style="font-size: 16pt;" class="material-icons right"/>check</i>
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <!-- Modal Structure -->
    <!-- <div id="modalAvaliacao" role="dialog" aria-labelledby="gridSystemModalLabel">
        <?php
           // $this->load->view('Avaliacao.php');
        ?>
    </div> -->
    
    <div id="modalAvaliacao" class="modal">
        <?php
            $this->load->view('Avaliacao.php');
        ?>
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
