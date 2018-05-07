<div class="modal-content">
    <h5 class="modal-title center" ng-if="isFilter">Filtrar serviços</h5>
    <h5 class="modal-title center" ng-if="!isFilter">Ordenar serviços</h5>
    <div class="container-fluid">
        <div class="row">
    		<form autocomplete="off" ng-if="isFilter">
                <div class="form-row">
                    <div class="row">
                        <div input-field class="session col s12 m6">
                            <i class="material-icons prefix">group_work</i>
                            <select 
                                ng-options="categoria.descricao for categoria in arrCategorias"
                                ng-model="arrCategorias.selectedCategory"
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
                                <input 
                                    type="text" 
                                    id="ajudante" 
                                    ng-model="ajudante" 
                                    class="autocomplete"
                                    />
                                <label for="ajudante">Ajudante</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Oculto por campo não fazer muito sentido
                    <div class="row">
                       <div class="col s12">
                           <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">sms</i>
                                    <input 
                                        class="form-control" 
                                        type="text" 
                                        ng-model="descricao" 
                                        id="descricao" 
                                        />
                                    <label for="descricao">Descrição</label>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <h6>Preço</h6>
                    <div class="divider"></div> 
                    <div class="row">
                       <div class="col s6">
                           <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">attach_money</i>
                                    <input
                                        id="minValor"
                                        class="form-control" 
                                        type="number" 
                                        ng-model="minValor" 
                                        />
                                    <label for="minValor">De</label>
                                </div>
                            </div>
                        </div>
                        <div class="col s6">
                           <div class="row">
                                <div class="input-field col s12">
                                    <input
                                        id="maxValor"
                                        class="form-control" 
                                        type="number" 
                                        ng-model="maxValor" 
                                        />
                                    <label for="maxValor">até</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6>Quantidade de estrelas</h6>
                    <div class="divider"></div> 
                    <div class="row">
                       <div class="col s6">
                           <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">star</i>
                                    <input
                                        id="minEstrela"
                                        class="form-control" 
                                        type="number" 
                                        ng-model="minEstrela" 
                                        />
                                    <label for="minEstrela">De</label>
                                </div>
                            </div>
                        </div>
                        <div class="col s6">
                           <div class="row">
                                <div class="input-field col s12">
                                    <input
                                        id="maxEstrela"
                                        class="form-control" 
                                        type="number" 
                                        ng-model="maxEstrela" 
                                        />
                                    <label for="maxEstrela">até</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form ng-if="!isFilter">
                <div class="form-row">
                    <h6>Ordenar por:</h6>
                    <div class="divider"></div> 
                    <div class="row col s12">
                        <select 
                            ng-options="option.description for option in orderFieldOptions"
                            ng-model="orderFieldOptions.selectedFieldOrder"
                            name="ordenacao"
                            id="ordenacao"
                            class="form-control"
                        >
                        </select>
                    </div>
                    <h6>Ordenar do:</h6>
                    <div class="divider"></div> 
                    <div class="row col s12">
                        <ul class="segmented-control">
                            <li class="segmented-control__item">
                                <input class="segmented-control__input" type="radio" value="desc" name="selectedOrder" id="selectedOrderDesc" checked>
                                <label class="segmented-control__label" for="selectedOrderDesc">Maior para o menor</label>
                            </li>
                            <li class="segmented-control__item">
                                <input class="segmented-control__input" type="radio" value="asc" name="selectedOrder" id="selectedOrderAsc" >
                                <label class="segmented-control__label" for="selectedOrderAsc">Menor para o maior</label>
                            </li>
                        </ul>
                    </div>   
                </div>

                <div ng-if="!isFilter">
                    <div class="col s12 text-center">
                        <button
                            name="btn_order"
                            id="btn_order"
                            ng-click="ordenar()"
                            class="waves-effect waves-light btn light-blue darken-2 col s12"
                        >Ordenar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-footer" ng-if="isFilter">
    <div ng-if="isFilter" class="row">
        <div class="col s12 text-center">
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