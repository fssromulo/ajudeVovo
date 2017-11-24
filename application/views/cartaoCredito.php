<div class="container-fluid" ng-controller="ctrlCartaoCredito">
 	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label for="numero_cartao">Número do Cartão:</label>
					<input type="text" ng-model="numero_cartao" class="form-control" id="numero_cartao" placeholder="numero_cartao" />
				</div>
   		</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label for="dt_validade">Data de Validade:</label>
					<input type="text" ng-model="dt_validade" class="form-control" id="dt_validade" placeholder="dt_validade" />
				</div>
   		</div>
   	</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label for="nome_titular">Nome do Titular:</label>
					<input type="text" ng-model="nome_titular" class="form-control" id="nome_titular" placeholder="nome_titular" />
				</div>
   	   </div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label for="codigo_seguranca">Código de Segurança(CVV):</label>
					<input type="text" ng-model="codigo_seguranca" class="form-control" id="codigo_seguranca" placeholder="Código de seguranca" />
				</div>
   	   </div>
   	</div>
   </div>

	<div class="row">
		<div class="col-md-6 col-md-offset-4">
			<div class="col-sm-12 col-md-12">
				<button type="button" ng-click="salvarCartao()" class="btn btn-success" ng-show="!is_alterar">
					Salvar
				</button>

				<button type="button" ng-click="salvarCartao()" class="btn btn-success" ng-show="is_alterar">
					Alterar
				</button>

				<button type="button" ng-click="cancelar()" class="btn btn-danger">
					Cancelar
				</button>
			</div>
		</div>
	</div>

	<br/>
</div> <!-- Fim da container do princical do bootstrap -->