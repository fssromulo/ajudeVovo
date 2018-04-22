<div class="container" ng-controller="ctrlCartaoCredito">
	<form>		
	 	<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="numero_cartao">Número do Cartão:</label>
						<input type="text" ng-model="numero_cartao" class="form-control" id="numero_cartao" placeholder="" />
					</div>
	   		</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="dt_validade">Data de Validade:</label>
						<input type="text" ng-model="dt_validade" id="dt_validade" placeholder="" />
					</div>
	   			</div>
	   		</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="nome_titular">Nome do Titular:</label>
						<input type="text" ng-model="nome_titular" class="form-control" id="nome_titular" placeholder="" />
					</div>
	   	   </div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="codigo_seguranca">Código de Segurança(CVV):</label>
						<input type="text" ng-model="codigo_seguranca" class="form-control" id="codigo_seguranca" placeholder="" />
					</div>
	   	   </div>
	   	</div>
	   </div>

		
		<div class="col s12 center-align">
			<div class="row">
				<div class="col s6">
					<button type="submit" ng-click="cancelar()" class="btn btn-danger waves-effect waves-light btn red darken-1 col s12">
						Cancelar
					</button>
				</div>

				<div class="col s6">
					<button type="submit" ng-click="salvarCartao()" class="waves-effect waves-light btn light-blue darken-2 col s12" ng-show="!is_alterar">
						Salvar
					</button>
				</div>

			</div>
		</div>
	</form>
</div>