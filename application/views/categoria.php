<html lang="pt_BR">
    <head>
        <title>Opa! Ajude o Vovô</title>
        <!-- jQuery & Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
        <link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
    </head>

    <body>
        <div ng-app="appAngular" ng-controller="controllerCategoria"s>
            <div class="container-fluid">

                <form class="form-group" name="form_categoria">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-md-offset-1">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" ng-model="descricao" class="form-control" id="descricao" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-md-offset-1">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="taxa">Taxa de cobrança (em %)</label>
                                    <input type="number" ng-model="taxa" class="form-control" id="taxa" min="0" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-4 col-md-offset-5">
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" ng-click="salvarCategoria()" class="btn btn-success" ng-show="!is_alterar">
                                    Salvar
                                </button>

                                <button type="submit" ng-click="alterarCategoria()" class="btn btn-success" ng-show="is_alterar">
                                    Alterar
                                </button>

                                <button type="button" ng-click="cancelar()" class="btn btn-danger">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <br>
            </div> <!-- Fim da container principal do bootstrap -->

            <table class="table table-stripped">
                <tr>
                    <th> Codigo </th>
                    <th> Descrição <th>
                    <th> Taxa <th>
                </tr>
                <tr ng-repeat="categoria in arrCategorias">
                    <td>{{categoria.id_categoria}}</td>
                    <td>{{categoria.descricao}}</td>
                    <td>{{categoria.taxa}}</td> 
                    <td>
                        <span style="cursor:pointer;" class="glyphicon glyphicon-edit" ng-click="carregarAlterar(categoria)"></span>
                        <span 
                        style="cursor:pointer;"
    				  			class="glyphicon glyphicon-remove"
    				  			data-toggle="modal"
    				  			data-target="#modal_excluir"
    				  			ng-click="carregarExcluir(categoria)"
    				  		>				  			
    				  		</span>
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
                            <button type="button" class="btn btn-success" ng-click="excluirCategoria()">Sim</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>

        <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>

        <!-- Compiled and minified JavaScript -->
        <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

        <!-- Angular JS -->
        <script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

        <link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
        <script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

        <!-- MY App -->
        <script type="text/javascript" src="../includes/js/categoria.js"></script>

    </body>
</html>