<div
	class="container"
	ng-controller="controllerAvaliacao"
>
	<div class="row">
		<div class="col 12">
			<div class="input-field">
				<label for="nota">Nota:</label>
				<div id="nota" name="nota" class="starbox" ng-model="nota"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<textarea class="materialize-textarea" ng-model="comentario" class="form-control" id="comentario" placeholder="Comentário..."></textarea>
		</div>
	</div>  
	<div class="row">
   <div class="col s12 center-align">
	   <div class="col s6">
			<button type="button" ng-click="cancelar()" class="waves-effect waves-light btn red darken-1 col s12" >
				Cancelar</button>
	   </div>
	   <div class="col s6">
				<button type="button" ng-click="salvarAvaliacao()" class="waves-effect waves-light btn light-blue darken-2 col s12">
					Salvar</button>
	   </div>
   </div>
   </div>
</div>