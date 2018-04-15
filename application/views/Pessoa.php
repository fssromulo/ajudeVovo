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
                        <!-- Mostra o este campo se estiver numa resolução de smartphones ou tablet para usar o calendário do proprio sistema operacional -->
                        <div  class="show-on-medium-and-down hide-on-large-only">
                           <input
                              type="date"                       
                              class="dt_nascimento_mobile"
                              ng-model="objPessoa.dt_nascimento_mobile"
                              id="dt_nascimento_mobile"
                              autocomplete="off"
                           />
                        </div>
                        <div class="hide-on-med-and-down show-on-large">
                        <!-- Mostra o este campo se estiver numa resolução de computador para renderizar um calendário do materialize -->                           
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
                        <label for="cpf">CPF</label>
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
                        <select multiple
                           name="necessidades"
                           id="necessidades"
                           ng-options="listaNecessidades.descricao for listaNecessidades in arrListaNecessidades"
                           ng-model="arrListaNecessidades.necessidade"
                           material-select watch
                        >
                           <option value=""  disabled selected>Selecione uma necessidade especial...</option>
                        </select>
                     </div>

                     
                       
                  </div>


                 <div ng-show="is_ajudante">
                  <div class="row">
                      <div class="session col s12 m12">
                        <span><strong>Insira a foto(imagem) de um documento seu. Exemplo: Identidade ou CNH.</strong></span>
                     </div>
                  </div>
                  <div class="row">
                      <div input-field class="session col s12 m6">
                         <div class="file-field input-field">
                           <div class="btn">
                             <span>Imagem Frente</span>
                              <input
                                 type="file"
                                 accept="image/jpg, image/jpeg, image/png"
                                 id="img_frente"
                                 onchange="angular.element(this).scope().getImgFrente(event)" 
                              />
                           </div>
                           <div class="file-path-wrapper">
                             <input class="file-path validate" type="text">
                           </div>
                         </div>
                      </div>
                      
                      <div input-field class="session col s12 m6">
                         <div class="file-field input-field">
                           <div class="btn">
                             <span>Imagem Verso</span>
                              <input
                                 type="file"
                                 accept="image/jpg, image/jpeg, image/png"
                                 id="img_verso"
                                 onchange="angular.element(this).scope().getImgVerso(event)" 
                              />
                           </div>
                           <div class="file-path-wrapper">
                             <input class="file-path validate" type="text">
                           </div>
                         </div>
                      </div>
                   </div>

                   <div class="row">
                      <div input-field class="session col s12 m6">
                         <input autocomplete="off" name="nome_mae" ng-model="objPessoa.nome_mae" id="nome_mae" type="text" class="validate">
                         <label for="nome_mae">Nome da m&atilde;e</label>                                       
                      </div>
                      
                      <div input-field class="session col s12 m6">
                         <input autocomplete="off" name="nome_pai" ng-model="objPessoa.nome_pai" id="nome_pai" type="text" class="validate">
                         <label for="nome_pai">Nome do pai</label>                  
                      </div>
                   </div>

                    <div class="row">
                       <div input-field class="session col s12 m6">
                          <select
                             ng-options="listaEstadoNascimento.descricao for listaEstadoNascimento in arrListaEstadoNascimento.options track by listaEstadoNascimento.id_estado"
                             ng-model="arrListaEstadoNascimento.estado"
                             name="estadoNascimento"
                             id="estadoNascimento"
                             ng-change="getListaCidadeNascimento()"
                             material-select watch
                          >
                             <option value="">Estado de origem...</option>
                          </select>
                       </div>                     


                       <div input-field class="session col s12 m6">
                          <select
                             ng-options="listaCidade.descricao for listaCidade in arrListaCidadeNascimento.options"
                             ng-model="arrListaCidadeNascimento.cidade"
                             name="cidadeNascimento"
                             id="cidadeNascimento"
                             material-select watch
                          >
                             <option value="">Cidade de nascimento...</option>
                          </select>
                       </div>  
                    </div>  
                  </div>  

                   <div class="row">
                     <div input-field class="session col s12 m6">

                         <div class="file-field input-field">
                           <div class="btn">
                             <span>Foto perfil</span>
                              <input type="file" accept="image/jpg, image/jpeg, image/png" ng-jcrop-input="upload" id="foto_perfil" />
                           </div>
                           <div class="file-path-wrapper">
                             <input class="file-path validate" type="text" id="ds_foto_perfil">
                           </div>
                         </div>

                          <div ng-jcrop="obj.src" ng-jcrop-config-name="upload" selection="obj.selection" thumbnail="obj.thumbnail"></div>
                     </div>            
                  </div>

               <div class="col s12 center-align">

               <div class="col s6">&nbsp;</div>
               <div class="col s6">&nbsp;
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
                        ng-options="listaEstadoEndereco.descricao for listaEstadoEndereco in arrListaEstadoEndereco.options track by listaEstadoEndereco.id_estado"
                        ng-model="arrListaEstadoEndereco.estado"
                        name="estado"
                        id="estado" 
                        ng-change="getListaCidadeEndereco()"
                        material-select watch
                     >
                        <option value="">Selecione um estado...</option>
                     </select>
                  </div>

                  <div input-field class="session col s12 m6">
                     <select
                        ng-options="listaCidade.descricao for listaCidade in arrListaCidadeEndereco.options"
                        ng-model="arrListaCidadeEndereco.cidade"
                        name="cidade"
                        id="cidade"
                        material-select watch
                     >
                        <option value="">Selecione uma cidade...</option>
                     </select>
                  </div>                  
               </div>

               <div class="row">                
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="bairro" ng-model="objPessoa.bairro" id="bairro" type="text" class="validate">
                     <label for="bairro">Bairro</label>  
                  </div>

                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="rua" ng-model="objPessoa.rua" id="rua" type="text" class="validate">
                     <label for="rua">Rua</label>                                       
                  </div>
                  
               </div>

               <div class="row">
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="nr_casa" ng-model="objPessoa.nr_casa" id="nr_casa" type="tel" class="validate">
                     <label for="nr_casa">Número da casa</label>                  
                  </div>
                  
                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="complemento" ng-model="objPessoa.complemento" id="complemento" type="text" class="validate">
                     <label for="complemento">Complemento</label>                                       
                  </div>
               </div>

               <div class="row">

                  <div input-field class="session col s12 m6">
                     <input autocomplete="off" id="cep" ng-model="objPessoa.cep" id="cep" type="tel" class="validate">
                     <label for="cep">CEP</label>                  
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
                        <label for="fone_residencial">Telefone residencial</label>                                       
                     </div>
                     
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="fone_comercial" ng-model="objPessoa.fone_comercial" id="fone_comercial" type="tel" class="validate">
                        <label for="fone_comercial">Telefone comercial</label>                  
                     </div>
                  </div>

                  <div class="row">
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="celular" ng-model="objPessoa.celular" id="celular" type="tel" class="validate">
                        <label for="celular">Celular</label>                                       
                     </div>
                     
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="email" ng-model="objPessoa.email" id="email" type="email" class="validate">
                        <label for="email">E-mail</label>                  
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
                  <h5>Dados de acesso</h5>
                  <div class="divider"></div> 

                  <div class="row">
                     <div input-field class="session col s12">
                        <input autocomplete="off" id="login" ng-model="objPessoa.login" id="login" type="text" class="validate">
                        <label for="login">Login</label>                                       
                     </div>
                  </div>

                  <div class="row">
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="senha1" ng-model="objPessoa.senha1" id="senha1" type="password" class="validate">
                        <label for="senha1">Senha</label>                                       
                     </div>
                     
                     <div input-field class="session col s12 m6">
                        <input autocomplete="off" id="senha2" ng-model="objPessoa.senha2" id="senha2" type="password" class="validate">
                        <label for="senha2">Repetir senha</label>                  
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