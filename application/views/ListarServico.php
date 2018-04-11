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
                <div class="fixed-action-btn">
                    <a
                        href="../Servico/"
                        class="btn-floating btn-large waves-effect waves-light light-blue darken-2">
                      <i class="material-icons">add</i></a>                      
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
                                        ng-click="editarServico(servico)"/>edit</i>
                                    <i class="material-icons right red-text darken-2"
                                        ng-click="carregarInativar(servico)"/>delete</i>
                                </div>
                                <br>
                            </div>
                        </li>
                    </ul>
                </table>
                </div>
            </div>

            <div class="modal fade" id="modal_excluir_servico" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="gridSystemModalLabel">Ajude o vovo!</h4>
                        </div>                        
                        <div class="modal-body">
                                Deseja excluir este registro?                            
                        </div>
                        <br><br>
                        <div class="modal-footer">
                            <button type="button" class="btn-flat blue-text" ng-click="fecharModalExcluir()">Não</button>
                            <button type="button" class="btn-flat blue-text" ng-click="inativarServico()">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            // Importa o cabeçalho rodape padrao a todas as telas
            $this->load->view('nucleo/footer.php');
        ?>
        <script type="text/javascript" src="../includes/js/listarServico.js"></script>
        <script type="text/javascript" src="../includes/js/MenuPrestador.controller.js"></script>
    </body>
</html>