<div
	class="modal-dialog" ng-controller="controllerAvaliacao"
>
	<div class="modal-content">
		
		<h5 class="modal-title">Realizar avaliação </h5>

		<div class="modal-body">
			<div class="col s12">
				<div class="input-field">
					<label for="nota">Nota:</label>
					<div id="nota" name="nota" class="starbox" ng-model="nota"></div>
				</div>
			</div>

			<div class="input-field col s12">
				<textarea class="materialize-textarea" ng-model="comentario" class="form-control" id="comentario" placeholder="Comentário..."></textarea>
			</div>
		</div>

		<div class="modal-footer">
			<div class="col s12">
				<button type="button" ng-click="cancelar()" class="waves-effect waves-light btn red darken-2 col s6">
					Cancelar
				</button>
				<button type="button" ng-click="salvarAvaliacao()" class="waves-effect waves-light btn light-blue darken-2 col s6">Salvar
				</button>
			</div>
		</div>
	</div>
</div>