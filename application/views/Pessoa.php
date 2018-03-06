<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>

</head>
<body>
<div 
   ng-app="appAngular"
   ng-controller="ctrlPessoa"
>
   <div class="container">
      <div class="row">
         <form class="col s12" name="frmCadastro">
            <!-- Perfil -->
            <!-- Perfil -->
            <input type="hidden" ng-model="is_ajudante" name="is_ajudante" ng-init="is_ajudante=<?php echo $ajudante;?>" />
            <input type="hidden" ng-model="is_contratante" name="is_contratante" ng-init="is_contratante=<?php echo $contratante;?>" />
            <!-- Perfil -->
            <!-- Perfil -->

            <div class="section">
               <h5>Dados Pessoais</h5>
               <div class="divider"></div> 
               <div class="row">
                  <input-field >
                     <input autocomplete="off" id="nome" ng-model="nome" id="nome" type="text" class="validate"> {{nome}}
                     <label for="nome">Nome</label>
                  </input-field>
                  <div input-field class="session col s12 m6">
                     <div  class="show-on-medium-and-down hide-on-large-only">
                        <input
                           class=""
                           ng-model="dt_nascimento3"
                           id="dt_nascimento"
                           type="date"                       
                        />
                     </div>
                     <div class="hide-on-med-and-down show-on-large"">
                        <input
                           input-date
                           type="text"
                           name="created"
                           id="inputCreated"
                           ng-model="currentTime"
                           format="dd/mm/yyyy"
                           months-full="{{ month }}"
                           months-short="{{ monthShort }}"
                           weekdays-full="{{ weekdaysFull }}"
                           weekdays-short="{{ weekdaysShort }}"
                           weekdays-letter="{{ weekdaysLetter }}"                               
                        />  
                        <label for="dt_nascimento">Data nascimento</label>
                     </div>
                  </div>            
               </div>
               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="cpf" ng-model="cpf" id="cpf" type="tel" class="validate">
                     <label for="cpf">CPF:</label>
                  </div>
                  <div input-field class="session col s12 m6">
                     <select
                        ng-options="listaSexo.descricao for listaSexo in arrListaSexo.options"
                        ng-model="arrListaSexo.sexoSelected"
                        name="sexo"
                        id="sexo"
                        material-select watch
                     >
                        <option value="" selected>Selecione um sexo...</option>
                     </select>
                  </div>            
               </div> 
            </div> 

            <div class="section">
               <h5>Endereço</h5>
               <div class="divider"></div> 
               <div class="row">
                  <div input-field class="session col s12 m6">
                        <select
                           ng-options="listaPais.descricao for listaPais in arrListaPais.options"
                           ng-model="arrListaPais.paisSelected"
                           ng-change="getListaEstado()"
                           name="pais"
                           id="pais"
                           class="form-control"
                           material-select watch
                        >
                           <option value="">Selecione um pais...</option>
                        </select>
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <select
                        ng-options="listaEstado.descricao for listaEstado in arrListaEstado.options track by listaEstado.id_estado"
                        ng-model="arrListaEstado.estadoSelected"
                        name="estado"
                        id="estado"
                        ng-change="getListaCidade()"
                        material-select watch
                     >
                        <option value="">Selecione um estado...</option>
                     </select>
                  </div>
               </div>
      

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <select
                        ng-options="listaCidade.descricao for listaCidade in arrListaCidade.options"
                        ng-model="arrListaCidade.cidadeSelected"
                        name="cidade"
                        id="cidade"
                        material-select watch
                     >
                        <option value="">Selecione uma cidade...</option>
                     </select>
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="bairro" ng-model="bairro" id="bairro" type="text" class="validate">
                     <label for="bairro">Bairro:</label>  
                  </div>
               </div>

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="rua" ng-model="rua" id="rua" type="text" class="validate">
                     <label for="rua">Rua:</label>                                       
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="nr_rua" ng-model="nr_rua" id="nr_rua" type="tel" class="validate">
                     <label for="nr_rua">Número da rua:</label>                  
                  </div>
               </div>

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="complemento" ng-model="complemento" id="complemento" type="text" class="validate">
                     <label for="complemento">Complemento:</label>                                       
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="cep" ng-model="cep" id="cep" type="tel" class="validate">
                     <label for="cep">CEP:</label>                  
                  </div>
               </div>
            </div>

            <div class="section">
               <h5>Contatos:</h5>
               <div class="divider"></div> 

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="fone_residencial" ng-model="fone_residencial" id="fone_residencial" type="tel" class="validate">
                     <label for="fone_residencial">Telefone residencial:</label>                                       
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="fone_comercial" ng-model="fone_comercial" id="fone_comercial" type="tel" class="validate">
                     <label for="fone_comercial">Telefone comercial:</label>                  
                  </div>
               </div>

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="celular" ng-model="celular" id="celular" type="tel" class="validate">
                     <label for="celular">Celular:</label>                                       
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="email" ng-model="email" id="email" type="email" class="validate">
                     <label for="email">E-mail:</label>                  
                  </div>
               </div>
            </div>

            <div class="section">
               <h5>Dados de acesso:</h5>
               <div class="divider"></div> 

               <div class="row">
                  <div input-field>
                     <input autocomplete="off" id="login" ng-model="login" id="login" type="text" class="validate">
                     <label for="login">Login:</label>                                       
                  </div>
               </div>

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="senha1" ng-model="senha1" id="senha1" type="password" class="validate">
                     <label for="senha1">Senha:</label>                                       
                  </div>
                  
                  <div  class="session col s12 m6">
                     <input input-field autocomplete="off" id="senha2" ng-model="senha2" id="senha2" type="password" class="validate">
                     <label for="senha2">Repetir senha:</label>                  
                  </div>
               </div>

               <div class="col s12 center-align">

               <div class="col s6">
                   <button
                        type="button" ng-click="cancelar()" 
                        class="waves-effect waves-light btn red darken-1 col s12" 
                     ><i class="material-icons left">arrow_back</i>Voltar
                     </button>
                 </div>
               <div class="col s6">

                     <button
                        type="submit"
                        ng-click="verificaAcao()"
                         class="waves-effect waves-light btn light-blue darken-2 col s12"
                        ng-show="!is_alterar"
                        ng-disabled="frmCadastro.$invalid"
                     >
                     <i class="material-icons right">arrow_forward</i>
                        Salvar
                     </button>

                 </div>
               </div>
            </div>
         </form>
      </div>


      <!-- Modal Structure -->
      <div id="modalCartaoCredito" class="modal">
          <div class="modal-content">
              <h4  id="modalCartaoCreditoLabel" >Cadastro dos dados financeiros</h4>
               <?php
                  $this->load->view('cartaoCredito.php');
               ?> 
          </div>
          <div class="modal-footer">
              <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
          </div>
      </div>

   </div>  
</div>  
      

    <script type="text/javascript" src="../includes/jQuery/jquery-3.2.1.js"></script>
    <?php
        // Importa o cabeçalho rodape padrao a todas as telas
        $this->load->view('nucleo/footer.php');
    ?> 


   <!-- MY App -->
   <script type="text/javascript" src="../includes/js/PessoaCartaoCredito.service.js?<?php echo date('YmdHis');?>"></script>
   <script type="text/javascript" src="../includes/js/cartaoCredito.js?<?php echo date('YmdHis');?>"></script>
   <script type="text/javascript" src="../includes/js/pessoa.js?<?php echo date('YmdHis');?>"></script>
   
</body>
</html>