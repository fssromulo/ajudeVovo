<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

</head>

    <body>

    <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('menuPrestador.php');
    ?>


        <div ng-app="appAngular" ng-controller="controllerListarServico">
           <div class="container-fluid">
            
            <div class="row">
                <div class="col-sm-12">&nbsp;</div>

<!--                 <div class="col-sm-12">
                    <div class="alert alert-info" role="alert">
                        <a href="../ControlePrestador/" class="alert-link">Consultar serviços solicitados</a>
                    </div>
                </div> -->
                
                <div class="col-sm-12 text-center">
                    <a class="btn btn-primary" href="../Servico/"><span class="glyphicon glyphicon-plus"></span> Adicionar Novo Serviço</a>
                </div>

                <div class="col-sm-12">&nbsp;</div>
                
                <table class="table table-stripped">
                    <tr>
                        <th> Codigo </th>
                        <th> Descrição </th>
                        <th> Valor </th>
                        <th> Detalhe </th>
                    </tr>
                    <tr ng-repeat="servico in arrListaServico">
                        <td>{{servico.id_servico}}</td>
                        <td>{{servico.descricao}}</td>
                        <td>{{servico.valor}}</td>
                        <td>{{servico.detalhe}}</td>
                        <td>
                            <span style="cursor:pointer;" class="glyphicon glyphicon-edit" 
                                ng-click="carregarAlterar(servico)"></span>
                            <span 
                                style="cursor:pointer;"
                                class="glyphicon glyphicon-remove"
                                data-toggle="modal"
                                data-target="#modal_excluir"
                                ng-click="carregarExcluir(servico)"
                            ></span>
                        </td>
                    </tr>
                </table>
            
            </div> <!-- Fim da container principal do bootstrap -->

            <div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">Ajude o vovo!!</h4>
                        </div>
                        
                        <div class="modal-body">
                                Deseja excluir este registro?                            
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" ng-click="excluirServico()">Excluir</button>
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
    
    </body>
</html>