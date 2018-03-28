<?php
    // Importa o cabeçalho padrao a todas as telas
    $this->load->view('nucleo/header.php');
?>
<style type="text/css">
  .tabs .indicator{
    background-color: #1889ff;
  }
    .ng-jcrop-image-wrapper { display: inline-block; }
    .ng-jcrop-thumbnail-wrapper { display: inline-block; }

    [ng-controller] { margin-bottom: 48px; }
    caption { text-align: left; }
</style>

</head>
<body>
<div 
   ng-app="appAngular"
   ng-controller="ctrlPessoa"
>
   <div class="container">
    <div class="row">
    <br/>
       <div class="col s12">
          <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#tab_dados_pessoais"><i class="material-icons blue-text #1889ff">person</i></a></li>
            <li class="tab col s3"><a href="#tab_endereco"><i class="material-icons blue-text #1889ff">home</i></a></li>
            <li class="tab col s3 "><a href="#tab_contatos"><i class="material-icons blue-text #1889ff">local_phone</i> </a></li>
            <li class="tab col s3"><a href="#tab_dados_acesso"><i class="material-icons blue-text #1889ff">https</i></a></li>
          </ul>
        </div>
    <br/>
    <br/>

         <form class="col s12" name="frmCadastro">
            <!-- Perfil -->
            <!-- Perfil -->
            <input type="hidden" ng-model="objPessoa.is_ajudante" name="is_ajudante" ng-init="is_ajudante=<?php echo $ajudante;?>" />
            <input type="hidden" ng-model="objPessoa.is_contratante" name="is_contratante" ng-init="is_contratante=<?php echo $contratante;?>" />
            <!-- Perfil -->
            <!-- Perfil -->

            <div id="tab_dados_pessoais" class="col s12">
              <div class="section">
                  <h5>Dados Pessoais</h5>
                  <div class="divider"></div> 
                  <div class="row">
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="nome" ng-model="objPessoa.nome" id="nome" type="text" class="validate">
                        <label for="nome">Nome</label>
                     </div>
                     <div input-field class="session col s12 m6">
                        <div  class="show-on-medium-and-down hide-on-large-only">
                           <input
                              class="dt_nascimento"
                              ng-model="objPessoa.dt_nascimento3"
                              id="dt_nascimento_mobile"
                              type="date"                       
                           />
                        </div>
                        <div class="hide-on-med-and-down show-on-large">
                           <input
                              autocomplete="off"
                              type="text"
                              class="dt_nascimento"
                              id="dt_nascimento"
                              ng-model="objPessoa.dt_nascimento"                         
                           />  
                           <label for="dt_nascimento">Data nascimento</label>
                        </div>
                     </div>            
                  </div>
                  <div class="row">
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="cpf" ng-model="objPessoa.cpf" id="cpf" name="cpf" type="tel" class="validate">
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

                     <div input-field class="session col s12 m6">

                         <div class="file-field input-field">
                           <div class="btn">
                             <span>Foto perfil</span>
                              <input type="file" ng-jcrop-input="upload" />
                           </div>
                           <div class="file-path-wrapper">
                             <input class="file-path validate" type="text">
                           </div>
                         </div>

                          <div ng-jcrop="obj.src" ng-jcrop-config-name="upload" selection="obj.selection" thumbnail="obj.thumbnail"></div>
                     </div>            
                  </div>

               <div class="col s12 center-align">

               <div class="col s6">
               <!--     <button
                        type="button" ng-click="cancelar()" 
                        class="waves-effect waves-light btn red darken-1 col s12" 
                     ><i class="material-icons left">arrow_back</i>Voltar
                     </button> -->
                 </div>
               <div class="col s6">

                     <button
                        type="button"
                        class="waves-effect waves-light btn light-blue darken-2 col s12"
                       data-ng-click="trocarAba('tab_endereco')"
                     >
                     <i class="material-icons right">arrow_forward</i>
                        Avan&ccedil;ar
                     </button>

                 </div>
               </div>

               </div>             
            </div>

            <div id="tab_endereco" class="col s12">
               <div class="section">
               <h5>Endereço</h5>
               <div class="divider"></div> 
               <div class="row">
                  <div input-field class="session col s12 m6">
                        <select
                           ng-options="listaPais.descricao for listaPais in arrListaPais.options"
                           ng-model="arrListaPais.pais"
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
                        ng-model="arrListaEstado.estado"
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
                        ng-model="arrListaCidade.cidade"
                        name="cidade"
                        id="cidade"
                        material-select watch
                     >
                        <option value="">Selecione uma cidade...</option>
                     </select>
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="bairro" ng-model="objPessoa.bairro" id="bairro" type="text" class="validate">
                     <label for="bairro">Bairro:</label>  
                  </div>
               </div>

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="rua" ng-model="objPessoa.rua" id="rua" type="text" class="validate">
                     <label for="rua">Rua:</label>                                       
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="nr_rua" ng-model="objPessoa.nr_rua" id="nr_rua" type="tel" class="validate">
                     <label for="nr_rua">Número da rua:</label>                  
                  </div>
               </div>

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="complemento" ng-model="objPessoa.complemento" id="complemento" type="text" class="validate">
                     <label for="complemento">Complemento:</label>                                       
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="cep" ng-model="objPessoa.cep" id="cep" type="tel" class="validate">
                     <label for="cep">CEP:</label>                  
                  </div>
               </div>

             <div class="col s12 center-align">

               <div class="col s6">
                   <button
                        type="button" ng-click="trocarAba('tab_dados_pessoais')" 
                        class="waves-effect waves-light btn red darken-1 col s12" 
                     ><i class="material-icons left">arrow_back</i>Voltar
                     </button>
                 </div>
               <div class="col s6">

                     <button
                        type="button"
                        class="waves-effect waves-light btn light-blue darken-2 col s12"
                       data-ng-click="trocarAba('tab_contatos')"
                     >
                     <i class="material-icons right">arrow_forward</i>
                        Avan&ccedil;ar
                     </button>

                 </div>
               </div>               
            </div>               

            </div>

            <div id="tab_contatos" class="col s12">
               <div class="section">
                  <h5>Contatos</h5>
                  <div class="divider"></div> 

                  <div class="row">
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="fone_residencial" ng-model="objPessoa.fone_residencial" id="fone_residencial" type="tel" class="validate">
                        <label for="fone_residencial">Telefone residencial:</label>                                       
                     </div>
                     
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="fone_comercial" ng-model="objPessoa.fone_comercial" id="fone_comercial" type="tel" class="validate">
                        <label for="fone_comercial">Telefone comercial:</label>                  
                     </div>
                  </div>

                  <div class="row">
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="celular" ng-model="objPessoa.celular" id="celular" type="tel" class="validate">
                        <label for="celular">Celular:</label>                                       
                     </div>
                     
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="email" ng-model="objPessoa.email" id="email" type="email" class="validate">
                        <label for="email">E-mail:</label>                  
                     </div>
                  </div>

             <div class="col s12 center-align">

               <div class="col s6">
                   <button
                        type="button" ng-click="trocarAba('tab_endereco')" 
                        class="waves-effect waves-light btn red darken-1 col s12" 
                     ><i class="material-icons left">arrow_back</i>Voltar
                     </button>
                 </div>
               <div class="col s6">

                     <button
                        type="button"
                        class="waves-effect waves-light btn light-blue darken-2 col s12"
                       data-ng-click="trocarAba('tab_dados_acesso')"
                     >
                     <i class="material-icons right">arrow_forward</i>
                        Avan&ccedil;ar
                     </button>

                 </div>
               </div>

               </div>               

            </div>

            <div id="tab_dados_acesso" class="col s12">

               <div class="section">
                  <h5>Dados de acesso:</h5>
                  <div class="divider"></div> 

                  <div class="row">
                     <div input-field class="session col s12">
                        <input autocomplete="off" id="login" ng-model="objPessoa.login" id="login" type="text" class="validate">
                        <label for="login">Login:</label>                                       
                     </div>
                  </div>

                  <div class="row">
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="senha1" ng-model="objPessoa.senha1" id="senha1" type="password" class="validate">
                        <label for="senha1">Senha:</label>                                       
                     </div>
                     
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="senha2" ng-model="objPessoa.senha2" id="senha2" type="password" class="validate">
                        <label for="senha2">Repetir senha:</label>                  
                     </div>
                  </div>               
               </div>               

               <div class="col s12 center-align">

               <div class="col s6">
                   <button
                        type="button" ng-click="trocarAba('tab_contatos')" 
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
            </div>
         </form>
      </div>


      <!-- Modal Structure -->
      <div id="modalCartaoCredito" class="modal">
          <div class="modal-content">
              <h4  id="modalCartaoCreditoLabel" >Cadastro dos dados financeiros</h4>
               <?php
                 $this->load->view('CartaoCredito.php');
               ?> 
          </div>
      </div>

   </div>  
</div>  
    
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