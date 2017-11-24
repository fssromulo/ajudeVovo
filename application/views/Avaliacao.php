<div
	class="container"
	ng-controller="controllerAvaliacao"
>
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label for="nota">Nota:</label>
				<input
					id="nota"
					name="nota" 
					class="kv-fa-heart rating-loading"
					data-min="0" 
					data-max="5" 
					data-step="1" 
					data-size="xs"
					ng-value="0"
					ng-model="nota">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-4">
				<label for="comentario">Comentário:</label>
				<textarea style="resize:none ;" ng-model="comentario" class="form-control" id="comentario" placeholder="Comentário..."></textarea>
		</div>
	</div>  

	<div class="row">
		<div class="col-sm-4">
			<button type="button" ng-click="salvarAvaliacao()" class="btn btn-success">
				Salvar
			</button>
			<button type="button" ng-click="cancelar()" class="btn btn-danger">
				Cancelar
			</button>
		</div>
	</div>
	<br/>
</div>