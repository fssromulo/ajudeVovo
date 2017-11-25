<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

</head>


<body>  

    <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('menuContratante.php');
    ?>
  <div ng-app="appAngular" ng-controller="controllerDetalheServico">	
    <input type="hidden" ng-model="is_contratante" name="is_contratante" ng-init="is_contratante=1" />
    <div class="container">
		<div class="row">
                    <!-- <div class="col-md-12 col-sm-10 col-md-offset-1"> -->
                        <div class="col-md-12 col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th width="10%">
                                                Serviço
                                            </th>
                                            <th width="10%">
                                                Ajudante
                                            </th>
                                            <th width="6%">
                                                Data - Horário
                                            </th>
                                            <th width="10%">
                                                Situação
                                            </th>
                                            <th width="10%">
                                                &nbsp;
                                            </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="lista in arrListaServico">
                                            <td title="{{lista.servico}}" >
                                                {{lista.servico}}
                                            </td>
                                            <td width="10%">
                                                {{lista.ajudante}}
                                            </td>
                                            <td width="6%">
                                                {{lista.dia}} - {{lista.horario_inicio}}&nbsp;até&nbsp;{{lista.horario_fim}}
                                            </td>
                                            <td width="10%">
                                                {{lista.situacao}}
                                            </td>
                                            <td width="10%">
                                                <div ng-show="{{lista.id_estado_operacao}} == 5">
                                                    <button 
                                                        title="Finalizar Serviço" 
                                                        ng-click="abrirTelaAvaliacao(lista.id_servico_solicitacao)"
                                                        class="btn btn-info"
                                                        style="font-size: 16px;">
                                                        <span class="glyphicon glyphicon-ok">
                                                        </span>
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>


        <!-- Modal -->
        <div class="modal fade" id="modalAvaliacao" tabindex="-1" role="dialog" aria-labelledby="modalAvaliacaoLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalAvaliacaoLabel">Realizar Avaliação </h4>
              </div>
              <div class="modal-body" >

                <?php
                    $this->load->view('Avaliacao.php');
                ?>  
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->


    </div>

   <script type="text/javascript" src="../includes/jQuery/jquery.js"></script>    
   <script type="text/javascript" src="../includes/star-rating/js/star-rating.min.js" ></script> 

    <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 


    <script type="text/javascript" src="../includes/js/RealizarAvaliacao.service.js"></script>
    <script type="text/javascript" src="../includes/js/ConsultaControleSolicitante.js"></script>
    <script type="text/javascript" src="../includes/js/Avaliacao.controller.js"></script>
</body>
</html>
