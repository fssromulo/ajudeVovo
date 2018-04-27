<div ng-controller="ctrlCartaoCredito">
	<div class="modal-content">
		<h5 class="modal-title">Dados financeiros</h5>
	    <br>
		<form>
		    <div>
	            <label for="numero_cartao">Número do Cartão:</label>
	            <input type="text" ng-model="numero_cartao" class="form-control" id="numero_cartao" placeholder="" />
		    </div>
		    <div>
	            <label for="dt_validade">Data de Validade:</label>
	            <input type="text" ng-model="dt_validade" id="dt_validade" placeholder="" />
		    </div>
		    <div>
	            <label for="nome_titular">Nome do Titular:</label>
	            <input type="text" ng-model="nome_titular" class="form-control" id="nome_titular" placeholder="" />
		    </div>
		    <div>
	            <label for="codigo_seguranca">Código de Segurança(CVV):</label>
	            <input type="text" ng-model="codigo_seguranca" class="form-control" id="codigo_seguranca" placeholder="" />
		    </div>
		</form>
	</div>
	<div class="modal-footer">
	    <button 
	    	type="submit" 
	    	ng-click="cancelar()" class="waves-effect waves-light btn red darken-2">
	        Cancelar
	    </button>
	    <button 
	    	type="submit" 
	    	ng-click="salvarCartao()" class="waves-effect waves-light btn light-blue darken-2" 
	    	ng-show="!is_alterar">
	        Salvar
	    </button>
	</div>
</div>