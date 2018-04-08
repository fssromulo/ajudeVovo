<div class="container-fluid">
    <div class="row">
		<form>
            <div class="form-row">
                <div class="row">
                    <div input-field class="session col s12 m6">
                         <select 
                            ng-options="option.description for option in orderOptions"
                            ng-model="orderOptions.model"
                            name="ordernacao"
                            id="ordernacao"
                            class="form-control"
                        >
                        </select> 
                        <label for="ordernacao">Ordenação:</label>
                    </div>
                </div>   
            </div>

            </div>

            <div class="row">
                <div class="col s12">
                    <div class="form-group">
                        <div class="col s12 col m6 text-center">
                            <div class="col m12">&nbsp;</div>
                            <button
                                name="btn_order"
                                id="btn_order"
                                ng-click="ordenar()"
                                class="waves-effect waves-light btn light-blue darken-2 col s12"
                            >Ordenar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>