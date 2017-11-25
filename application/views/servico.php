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


        <div
            ng-app="appAngular"
            ng-controller="controllerServico"
        >
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-10">
                        &nbsp;
                    </div>
                </div>

                    
                <div class="col-sm-10 col-lg-offset-1"> 

                    <form class="form-group" name="form_servico">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição:</label>
                                    <input type="text" ng-model="descricao" class="form-control" id="descricao" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="categoria">Categoria:</label>
                                    <select 
                                        ng-options="listaCategoria.descricao for listaCategoria in arrListaCategoria"
                                        ng-model="categoriaSelected"
                                        name="categoria"
                                        id="categoria"
                                        class="form-control"
                                        required
                                    >
                                        <option value="">Selecione uma categoria...</option>
                                    </select>

                                    <br>

                                    <button 
                                        type="button"
                                        class="btn btn-link btn-xs"
                                        ng-click="sugerirCategoria()"> Não encontrei minha categoria </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="valor">Valor:</label>
                                    <input type="number" ng-model="valor" class="form-control" id="valor" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="valor">Dia de Atendimento </label>
                                    <select 
                                        ng-options="listaDiaAtendimento.descricao for listaDiaAtendimento in arrListaDiaAtendimento"
                                        ng-model="diaAtendimentoSelected"
                                        name="diaAtendimento"
                                        id="diaAtendimento"
                                        class="form-control"
                                    >
                                        <option value="">Selecione o dia da semana...</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="horario_inicio">Horário de Início </label>
                                            <input type="time" ng-model="horario_inicio" id="horario_inicio" name="horario_inicio" class="form-control"/>
                                        </div>

                                        <div class="col-sm-12 col-md-4">
                                            <label for="horario_fim">Horário de Fim </label> 
                                            <input type="time" ng-model="horario_fim" id="horario_fim" name="horario_fim" class="form-control"/>
                                        </div>

                                        <div class="col-sm-12 col-md-4 text-center">
                                            <div class="col-sm-12">&nbsp;</div>
                                            <button type="button" ng-click="adicionarDiaAtendimento()" class="btn btn-primary">
                                                Adicionar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Dia da Semana
                                                </th>
                                                <th>
                                                    Horário Início
                                                </th>
                                                <th>
                                                    Horário Fim
                                                </th>
                                                <th>
                                                    <!-- Ação para excluir o dia de atendimento -->
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="lista in arrListaAtendimento">
                                                <td>
                                                    {{lista.dia}}
                                                </td>
                                                <td>
                                                    {{lista.horario_inicio}}
                                                </td>
                                                <td>
                                                    {{lista.horario_fim}}
                                                </td>
                                                <td>
                                                    <span class="glyphicon glyphicon-remove" ng-click="removerDiaAtendimento($index)"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="detalhe">Detalhes do Serviço:</label>
                                        <textarea style="resize: none;" class="form-control" ng-model="detalhe" name="detalhe" id="detalhe" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="col-sm-12">
                                    <button type="submit" ng-click="salvarServico()" class="btn btn-success" ng-show="!is_alterar">
                                        Salvar
                                    </button>

                                    <button type="submit" ng-click="alterarServico()" class="btn btn-success" ng-show="is_alterar">
                                        Alterar
                                    </button>

                                    <button type="button" ng-click="cancelar()" class="btn btn-danger">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br/>
                </div> <!-- Fim da container principal do bootstrap -->
            </div>

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
        <script type="text/javascript" src="../includes/js/servico.js"></script>
    
    </body>
</html>