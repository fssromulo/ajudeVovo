<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>
</head>
    <body>
        <div 
            data-ng-cloak 
            ng-app="appAngular"
            ng-controller="controllerListarServico"
        >
            <?php
                // Importa o cabeçalho padrao a todas as telas
                $this->load->view('MenuPrestador.php');
            ?>

            <!-- componente de feedback para os usuários -->
            <carregavovo data-ng-show="is_carregando_pagina"></carregavovo> 
            <!-- componente de feedback para os usuários -->

           <div class="container">

            <div class="row">
                <div class="fixed-action-btn">
                    <a
                        href="../Servico/"
                        class="btn-floating btn-large waves-effect waves-light light-blue darken-2">
                      <i class="material-icons">add</i></a>                      
                </div>

                <div class="s12">
                    <p ng-if="arrListaServico.length < 1" style="font-size: 20px; text-align: center;">Você ainda não possui serviços cadastrados!</p>
                            
                <table class="table table-stripped">
                    <ul class="collapsible" data-collapsible="accordion" ng-if="arrListaServico.length > 0">
                        <li ng-repeat="servico in arrListaServico">
                            <div class="collapsible-header">{{servico.descricao}}</div>
                            <div class="collapsible-body">
                                <span>Detalhes: {{servico.detalhe}}</span>
                                <br><br>
                                <span ng-if="servico.valor != 'R$ 0,00'">Valor: {{servico.valor}}</span>
                                <span ng-if="servico.valor == 'R$ 0,00'">Serviço gratuito</span>
                                <br><br><br>
                                <div class="col s12">
                                    <i style="cursor: pointer" 
                                        class="material-icons right blue-text"
                                        ng-click="editarServico(servico)"/>edit</i>
                                    <i style="cursor: pointer"
                                        class="material-icons right red-text darken-2"
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
                        <h5 class="modal-title" id="modal_excluir_servico_label">Excluir serviço?</h5>
                        <div class="modal-footer">
                            <button class="waves-effect waves-light btn red darken-2 col s6" 
                                ng-click="fecharModalExcluir()">Cancelar
                            </button>
                            <button class="waves-effect waves-light btn blue darken-2 col s6"
                                ng-click="inativarServico()">Excluir
                            </button>
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