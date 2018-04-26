<form class="col s12" name="frmDadosAcesso" novalidate>
   <div class="section">
      <h5>Dados de acesso</h5>
      <div class="divider"></div> 

      <div class="row">
         <div input-field class="session col s12">
            <input autocomplete="off" id="login" ng-model="objPessoa.login" id="login" type="text"  required />
            <label for="login">Login</label>                                       
         </div>
      </div>

      <div class="row">
         <div input-field class="session col s12 m6">
            <input autocomplete="off" id="senha1" ng-model="objPessoa.senha1" id="senha1" type="password"  required />
            <label for="senha1">Senha</label>                                       
         </div>
         
         <div input-field class="session col s12 m6">
            <input autocomplete="off" id="senha2" ng-model="objPessoa.senha2" id="senha2" type="password"  required />
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
               ng-disabled="frmDadosAcesso.$invalid"
            >
            <i class="material-icons right">arrow_forward</i>
               Salvar
            </button>
      </div>
   </div>
</form>