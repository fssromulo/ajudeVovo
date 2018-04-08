<div class="container-fluid">
    <div class="row">
		<form autocomplete="off">
            <div class="form-row">
                <div class="row">
                    <div input-field class="session col s12 m6">
                        <i class="material-icons prefix">group_work</i>
                        <select 
                            ng-options="categoria.descricao for categoria in arrCategorias"
                            ng-model="arrCategorias.id_categoria"
                            name="categoria"
                            id="categoria"
                            class="form-control"
                        >
                        </select>
                        <label for="categoria">Categoria:</label>
                    </div>
                 </div>

                <div class="row">
                    <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" id="ajudante" ng-model="filter.ajudante" class="autocomplete">
                        <label for="ajudante">Ajudante</label>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                   <div class="col s12">
                   <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">sms</i>
                            <input 
                                class="form-control" 
                                type="text" 
                                ng-model="filter.descricao" 
                                id="descricao" 
                                />
                            <label for="descricao">Descrição do serviço</label>
                        </div>
                    </div>
                    </div>
                </div>               

                <div class="row">
                    <div class="col s8 center-align">
                        <div id="valor"></div>
                        <label for="valor">Preço R$</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col s8">
                        <div id="estrelas"></div>
                        <label for="estrelas">Estrelas</label>
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
                                name="btn_filter"
                                id="btn_filter"
                                ng-click="filtrar()"
                                class="waves-effect waves-light btn light-blue darken-2 col s12"
                            >Filtrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>