<div class="container-fluid" ng-controller="controllerDetalheServico">
    <br>
    <div class="row">
		<form>
            <div class="form-row">
               <div class="row">
                   <div class="col s12">
                      <label for="nomeServico">Serviço:</label>
                      <input 
                        class="form-control" 
                        type="text" 
                        ng-model="arrListaServico.descricao" id="descricao" 
                        placeholder="descricao" 
                        readonly/>
                    </div>
                </div>
                               
                <div class="row">
                    <div class="col s12">
                        <label for="categoriaServico">Categoria:</label>
                        <input 
                            class="form-control" 
                            type="text" 
                            ng-model="arrListaServico.categoria" 
                            placeholder="Jardim" 
                            readonly/>
                    </div>
                 </div>
            </div>

            </div>
		    <div class="form-group">
			 	<h5 class="center">Horários Disponíveis</h5>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>
                                            Dia da Semana
                                        </th>
                                        <th>
                                            Horário Início
                                        </th>
                                        <th>
                                            Horário Fim
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lista in arrListaDiaHorario">
                                        <td>
                                            {{lista.dia}}
                                        </td>
                                        <td>
                                            {{lista.horario_inicio}}
                                        </td>
                                        <td>
                                            {{lista.horario_fim}}
                                        </td>   
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>

            <div class="row">
                <div class="form-group">
                    <div class="col s12">
                        <label for="dia">Dia:</label>
                        <div >
                            <input type="date" id="vlData" class="form-control" ng-model="dia_solicitacao">
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="row col s12">
                <div class="col s6">
                    <label for="horario_inicio">Horário de Início </label>
                    <input type="time" ng-model="horario_inicio" id="horario_inicio"  ng-model="horario_inicio" name="horario_inicio" class="form-control" required/>
                </div>
                
                <div class="col s6">
                    <label for="horario_fim">Horário de Fim </label> 
                    <input type="time" ng-model="horario_fim" id="horario_fim"  ng-model="horario_fim" name="horario_fim" class="form-control" required/>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="col s12 col m12 text-center">
                        <div class="col m6">&nbsp;</div>
                        <button
                            name="btn_servico"
                            id="btn_servico"
                            ng-click="salvarServico()"
                            class="waves-effect waves-light btn light-blue darken-2 col s12"
                            ng-disabled="bloquear_btn_servico"
                        >Confirmar Solicitação
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">&nbsp;</div>

            <div class="row">
                <div class="alert alert-info" role="alert">
                    <a href="../ControleSolicitante/" class="alert-link">Clique aqui para acompanhar sua solicitação!</a>
                </div>
            </div>
        </form>
    </div>
</div>