<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

</head>

    <body>

        <div ng-app="appAngular" ng-controller="controllerListarServico">
            <?php
                // Importa o cabeçalho padrao a todas as telas
                $this->load->view('MenuPrestador.php');
            ?>
           <div class="container">
            
            <div class="row">
                <div class="col-sm-12">&nbsp;</div>            
                
                <div class="fixed-action-btn">
                    <a class="btn-floating btn-large waves-effect waves-light light-blue darken-2" href="../Servico/">
                      <i class="material-icons">add</i>
                    </a>
                </div>

                <div class="col-sm-12">&nbsp;</div>
                
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                <table class="table table-stripped">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li ng-repeat="servico in arrListaServico">
                            <div class="collapsible-header">{{servico.descricao}}</div>
                            <div class="collapsible-body">
                                <span>Detalhes do serviço: {{servico.detalhe}}</span>
                                <br><br>
                                <span>Valor do serviço: {{servico.valor}}</span>
                                <br><br><br>
                                <div class="col s12">
                                    <i class="material-icons right blue-text"
                                        ng-click="alterarServico(servico)"/>edit</i>
                                    <i class="material-icons right red-text darken-2"
                                        ng-click="carregarInativar(servico)"/>delete</i>
                                </div>
                                <br>
                            </div>
                        </li>
                    </ul>
                </table>
                </div>
            </div> <!-- Fim da container principal do bootstrap -->

            <div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="gridSystemModalLabel">Ajude o vovo!!</h4>
                        </div>
                        
                        <div class="modal-body">
                                Deseja excluir este registro?                            
                        </div>
                        <br><br>
                        <div class="modal-footer">
                            <button type="button" class="btn-flat blue-text" ng-click="fecharModalExcluir()">Não</button>
                            <button type="button" class="btn-flat blue-text" ng-click="inativarServico()">Sim</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>

<!-- 
     
        <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

     
        <script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

        <link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
        <script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script> -->

        <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>
        <?php
            // Importa o cabeçalho rodape padrao a todas as telas
            $this->load->view('nucleo/footer.php');
        ?> 

        <!-- MY App -->
        <script type="text/javascript" src="../includes/js/listarServico.js"></script>
        <script type="text/javascript" src="../includes/js/MenuPrestador.controller.js"></script>
    </body>
</html>