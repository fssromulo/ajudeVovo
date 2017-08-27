<html lang="pt_BR">
    <head>
        <title>Opa! Ajude o Vovô</title>
        <!-- jQuery & Bootstrap -->

        <link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
        <link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
    </head>

    <body ng-app="appAngular" ng-controller="controllerCategoria" >
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="nome">Descrição:</label>
                            <input type="text" ng-model="descricao" class="form-control" id="descricao" placeholder="Descrição" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-5">
                <div class="col-sm-12 col-md-6">
                    <button type="submit" ng-click="salvar()" class="btn btn-success" ng-show="!is_alterar">
                        Salvar
                    </button>

                    <button type="submit" ng-click="salvar()" class="btn btn-success" ng-show="is_alterar">
                        Alterar
                    </button>

                    <button type="button" ng-click="cancelar()" class="btn btn-danger">
                        Cancelar
                    </button>
                </div>
            </div>
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