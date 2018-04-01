<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

  <!-- CSS  -->
<!--   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

</head>
<body>
   <?php
        // Importa o cabeçalho padrao a todas as telas
        $this->load->view('MenuAdministracao.php');
    ?>

  <div class="user-view">
    <div ng-app="appAngular" ng-controller="ctrlrAdmCadastroPerfil">
      
      <div class="container">
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s6">
                <input placeholder="Descrição do perfil" id="descricao" type="text" class="validate">
                <label for="descricao">Descrição</label>
              </div>
            </div>
            <div class="row">
              <button class="btn waves-effect waves-light" type="submit" name="action">
                Salvar
              </button>
              <button class="btn waves-effect waves-light" type="submit" name="action">
                Editar
              </button>
              <button class="btn waves-effect waves-light" type="submit" name="action">
                Excluir
              </button>
            </div>
          </form>
        </div>

       <table class="responsive-table">
              <tr>
                  <th> Id </th>
                  <th> Descrição <th>
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
    </div>
  </div>  


  <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 

    <script type="text/javascript" src="../includes/js/AdmCadastroPerfil.js"></script>

  </body>
</html>