<html lang="pt_BR">
    <head>
        <title>Opa! Ajude o Vovô</title>
        <!-- jQuery & Bootstrap -->

        <link href="../includes/bootstrap-3.3.7/css/bootstrap-theme.min.css"  type="text/css" rel="stylesheet" />
        <link href="../includes/bootstrap-3.3.7/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
    </head>

    <body ng-app="appAngular" ng-controller="controllerListarServico">

    	<div class="container-fluid">
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
                    <span style="cursor:pointer;" class="glyphicon glyphicon-edit" ng-click="carregarAlterar(servico)"></span>
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

		<script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>

        <!-- Compiled and minified JavaScript -->
        <script type="text/javascript" src="../includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>  

        <!-- Angular JS -->
        <script type="text/javascript" src="../includes/angular/angular.min.js"></script>  

        <link rel='stylesheet' href='../includes/js/angular-loading-bar/build/loading-bar.min.css' type='text/css' media='all' />
        <script type='text/javascript' src='../includes/js/angular-loading-bar/build/loading-bar.min.js'></script>

        <!-- MY App -->
        <script type="text/javascript" src="../includes/js/listarServico.js"></script>
    
    </body>
</html>