<form class="col s12" name="frmContatos" novalidate>
	<div class="section">
	   <h5>Contatos</h5>
	   <div class="divider"></div> 
	   <div class="row">
	      <div input-field class="session col s12 m6">
	         <input autocomplete="off" class="cls-mascara-fone" ng-model="objPessoa.fone_residencial" id="fone_residencial" type="tel" />
	         <label for="fone_residencial">Telefone residencial</label>                                       
	      </div>
	      
	      <div input-field class="session col s12 m6">
	         <input autocomplete="off" id="fone_comercial" ng-model="objPessoa.fone_comercial" class="cls-mascara-fone" type="tel" />
	         <label for="fone_comercial">Telefone comercial</label>                  
	      </div>
	   </div>

	   <div class="row">
	      <div input-field class="session col s12 m6">
	         <input autocomplete="off" id="celular" ng-model="objPessoa.celular" class="cls-mascara-fone" type="tel" required />
	         <label for="celular">Celular * </label>                                       
	      </div>
	      
	      <div input-field class="session col s12 m6">
	         <input autocomplete="off" id="email" ng-model="objPessoa.email" id="email" type="email"  required />
	         <label for="email">E-mail * </label>                  
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
		        data-ng-disabled="!frmContatos.$valid"
		        
		      >
		      <i class="material-icons right">arrow_forward</i>
		         Avan&ccedil;ar
		      </button>
		  	</div>
		</div>
	</div>
</form>