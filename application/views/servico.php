<html lang="pt_BR">
    <head>
        <title>Opa! Ajude o Vovô</title>
        <!-- jQuery & Bootstrap -->

        <link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
        <link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
    </head>

    <body ng-app="appAngular" ng-controller="controllerServico" >
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <input type="text" ng-model="descricao" class="form-control" id="descricao" placeholder="Descrição"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="valor">Valor:</label>
                            <input type="text" ng-model="valor" class="form-control" id="valor" placeholder="Valor" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="categoria">Categoria:</label>
                            <select 
                                ng-options="listaCategoria.descricao for listaCategoria in arrListaCategoria"
                                ng-model="categoriaSelected"
                                name="categoria"
                                id="categoria"
                                class="form-control"
                            >
                                <<option value="">Selecione uma categoria...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="prestador">Prestador:</label>
                            <select 
                                ng-options="listaPrestador.nome for listaPrestador in arrListaPrestador"
                                ng-model="prestadorSelected"
                                name="prestador"
                                id="prestador"
                                class="form-control"
                            >
                                <<option value="">Selecione um prestador...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-md-offset-5">
                    <div class="col-sm-12 col-md-6">
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

            <br>
        </div> <!-- Fim da container do princical do bootstrap -->

        <table class="table table-stripped">
            <tr>
                <th> Codigo </th>
                <th> Descrição <th>
                <th> Valor <th>
            </tr>
            <tr ng-repeat="servico in arrListaServico">
                <td>{{servico.id_servico}}</td>
                <td>{{servico.descricao}}</td>
                <td>{{servico.valor}}</td>
                <td>
                    <span style="cursor:pointer;" class="glyphicon glyphicon-edit" ng-click="carregarAlterar(servico)"></span>
                    <span 
                        style="cursor:pointer;"
                        class="glyphicon glyphicon-remove"
                        data-toggle="modal"
                        data-target="#modal_excluir"
                        ng-click="carregarExcluir(servico)"
                    ><span>
                </td>
            </tr>
        </table>

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
                        <button type="button" class="btn btn-danger" data-dismiss="modal" >Não</button>
                        <button type="button" class="btn btn-success" ng-click="excluirServico()">Sim</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>

        <!-- Compiled and minified JavaScript -->
        <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

        <!-- Angular JS -->
        <script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

        <link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
        <script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

        <!-- MY App -->
        <script type="text/javascript" src="../includes/js/servico.js"></script>

    </body>
</html>