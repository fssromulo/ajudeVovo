<form class="col s12" name="frmDadosEndereco" novalidate>
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
					required
				>
					<option value="">Selecione um estado *</option>
				</select>
			</div>

			<div input-field class="session col s12 m6">
				<select
				ng-options="listaCidade.descricao for listaCidade in arrListaCidadeEndereco.options"
				ng-model="arrListaCidadeEndereco.cidade"
				name="cidade"
				id="cidade"
				material-select watch
				required
				>
					<option value="">Selecione uma cidade *</option>
				</select>
			</div>                  
		</div>

		<div class="row">                
			<div input-field class="session col s12 m6">
				<input autocomplete="off" id="bairro" ng-model="objPessoa.bairro"  type="text"  required/>
				<label for="bairro">Bairro * </label>  
			</div>

			<div input-field class="session col s12 m6">
				<input autocomplete="off" id="rua" ng-model="objPessoa.rua" type="text"  required />
				<label for="rua">Rua * </label>                                       
			</div>
		</div>

		<div class="row">
			<div input-field class="session col s12 m6">
				<input  type="tel" autocomplete="off" id="nr_casa" ng-model="objPessoa.nr_casa"  required>
				<label for="nr_casa">Número da casa * </label>                  
			</div>

			<div input-field class="session col s12 m6">
				<input autocomplete="off" id="complemento" ng-model="objPessoa.complemento" type="text" />
				<label for="complemento">Complemento</label>                                       
			</div>
		</div>

		<div class="row">
			<div input-field class="session col s12 m6">
				<input autocomplete="off" id="cep" ng-model="objPessoa.cep" type="tel"  required/>
				<label for="cep">CEP * </label>                  
			</div>
		</div>
	
		<div class="row">
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
					data-ng-disabled="!frmDadosEndereco.$valid"
					>
					<i class="material-icons right">arrow_forward</i>
					Avan&ccedil;ar
					</button>

				</div>
			</div>               
		</div> 
	</div>
</form>              