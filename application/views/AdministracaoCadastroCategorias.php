<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

 <!-- CSS  -->
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!--<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->
</head>

    <body>
        <div ng-app="appAngular" ng-controller="controllerAdministracaoCadastroCategoria">
            <div class="">

                <form class="form-group" name="form_categoria">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-md-offset-1">
                            <div class="col-sm-12 col-md-6">
                                <div class="">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" ng-model="descricao" class="validate" id="descricao" required />
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
                                <button type="submit" ng-click="salvarCategoria()" class="waves-effect waves-light btn" ng-show="!is_alterar">
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

      <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 

  </body>
</html>
