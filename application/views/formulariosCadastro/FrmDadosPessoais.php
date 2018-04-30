<form class="col s12" name="frmDadosPessoais" novalidate>
   <div class="section">
      <h5>Dados Pessoais</h5>
      <div class="divider"></div> 
      <div class="row">
         <div input-field class="session col s12 m6">
            <input autocomplete="off" id="nome" ng-model="objPessoa.nome" name="nome" type="text"  required/>
            <label for="nome">Nome *</label>
         </div>
         <div input-field class="session col s12 m6">
            <!-- Mostra o este campo se estiver numa resolução de smartphones ou tablet para usar o calendário do proprio sistema operacional -->
            <!-- <div  class="show-on-medium-and-down hide-on-large-only"> -->
            <div >
               <input
                  type="date"                       
                  class="dt_nascimento_mobile"
                  ng-model="objPessoa.dt_nascimento_mobile"
                  id="dt_nascimento_mobile"
                  autocomplete="off"
                  required
               />
               
            </div>
            <!-- <div class="hide-on-med-and-down show-on-large"> -->
            <!-- Mostra o este campo se estiver numa resolução de computador para renderizar um calendário do materialize -->                           
               <!-- <input
                  autocomplete="off"
                  type="text"
                  class="dt_nascimento"
                  id="dt_nascimento"
                  ng-model="objPessoa.dt_nascimento"
                                           
               />  
               <label for="dt_nascimento">Data nascimento</label>
            </div> -->
         </div>            
      </div>
      <div class="row">
         <div input-field class="session col s12 m6">
            <input autocomplete="off" id="cpf" ng-model="objPessoa.cpf" name="cpf" type="tel" required />
            <label for="cpf">CPF *</label>
         </div>
         <div input-field class="session col s12 m6">
            <select
               ng-options="listaSexo.descricao for listaSexo in arrListaSexo.options"
               ng-model="arrListaSexo.sexoSelected"
               name="sexo"
               id="sexo"
               material-select watch
               required
            >
               <option value=""  disabled selected>Selecione um sexo *</option>
            </select>
         </div>
         <div data-ng-if="is_contratante" input-field class="session col s12 m6">
            <select multiple
               name="necessidades"
               id="necessidades"
               ng-options="listaNecessidades.descricao for listaNecessidades in arrListaNecessidades"
               ng-model="arrListaNecessidades.necessidade"
               material-select watch
            >
               <option value=""  disabled selected>Selecione uma necessidade especial *</option>
            </select>
         </div>                          
      </div>

     <div data-ng-if="is_ajudante">
      <div class="row">
          <div class="session col s12 m12">
            <span><strong>Informe aqui a foto(imagem) de um documento seu. Exemplo: Identidade ou CNH.</strong></span>
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
                     required
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
          <div class="session col s12 m12">
            <span><strong>Queremos saber um pouco mais sobre você :) ...</strong></span>
         </div>
          <div input-field class="session col s12 m6">
             <input autocomplete="off" name="nome_mae" ng-model="objPessoa.nome_mae" id="nome_mae" type="text" required >
             <label for="nome_mae">Nome da m&atilde;e *</label>                                       
          </div>
          
          <div input-field class="session col s12 m6">
             <input autocomplete="off" name="nome_pai" ng-model="objPessoa.nome_pai" id="nome_pai" type="text" >
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
                 <option value="">Estado de origem *</option>
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
                 <option value="">Cidade de nascimento *</option>
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
           data-ng-disabled="!frmDadosPessoais.$valid"
         >
         <i class="material-icons right"  >arrow_forward</i>
            Avan&ccedil;ar
         </button>

     </div>
   </div>

   </div>
</form>