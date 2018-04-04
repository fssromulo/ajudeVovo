<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>
</head>
<body>
   <?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('MenuAdministracao.php'); ?>
  <div class="user-view">
    <div ng-app="appAngular" ng-controller="ctrlrAdmCadastroCategoria">
    
        <div class="container">
            <div class="row">

                <form class="col s12" name="form_categoria">
                    <label for="descricao">Descrição</label>
                    <input type="text" ng-model="descricao" class="validate" id="descricao" />
                
                    <div class="row">
                        <label for="taxa">Taxa de cobrança (em %)</label>
                        <input type="number" ng-model="taxa" class="validate" id="taxa" min="0"/>
                    </div>
                                       
                    <div class="row">
                        <button type="submit" ng-click="salvarCategoria()" class="waves-effect waves-light btn" ng-show="!is_alterar">
                            Salvar
                        </button>

                        <button type="submit" ng-click="alterarCategoria()" class="waves-effect waves-light btn" ng-show="is_alterar">
                            Alterar
                        </button>

                        <button type="button" ng-click="cancelar()" class="waves-effect waves-light btn">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>                    
            <br>
            <table class="responsive-table">
                <tr>
                    <th> Codigo </th>
                    <th> Descrição <th>
                    <th> Taxa <th>
                </tr>
                <tr ng-repeat="lista in arrCategorias">
                    <td>{{lista.id_categoria}}</td>
                    <td>{{lista.descricao}}</td>
                    <td>{{lista.taxa}}</td> 
                    <td>
                        <span style="cursor:pointer;" class="material-icons" ng-click="carregarAlterar(lista)">create</span>
                        <span   style="cursor:pointer;"
                                class="material-icons"
                                data-toggle="modal"
                                data-target="#modal_excluir"
                                ng-click="carregarExcluir(lista)"> delete              
                        </span>
                    </td>
                </tr>
            </table>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal" >Não</button>
                            <button type="button" class="btn btn-success" ng-click="excluirCategoria()">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 
    <script type="text/javascript" src="../includes/js/AdmCadastroCategorias.js"></script>
  </body>
</html>