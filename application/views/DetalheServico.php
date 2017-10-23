<div
    class="container-fluid"
    ng-controller="controllerDetalheServico"
>
	<div class="row">
		<form>
            <div class="form-row">
               <div class="row">
                   <div class="col-sm-12">
                      <label for="nomeServico">Serviço:</label>
                      <input class="form-control" type="text" ng-model="arrListaServico.descricao" id="descricao" placeholder="descricao" readonly/>
                    </div>
                </div>
                
                <div class="row">&nbsp;</div>
                               
                <div class="row">
                    <div class="col-sm-12">
                      <label for="categoriaServico">Categoria:</label>
                      <input class="form-control" type="text" ng-model="arrListaServico.categoria" placeholder="Jardim" readonly>
                    </div>
                 </div>
                </div>
            </div>

		    <div class="form-group">
		    	</br>
			 	<h2>Horários Disponíveis</h2>
			 	</br></br>
			 	
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="col-sm-12 col-md-6">
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

			</div>

            <div class="row">
                <div class="form-group">
                    <label for="dia">Dia:</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input id="vlData" type="text" class="form-control" ng-model="dia_solicitacao">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                    <label for="horario_inicio">Horário de Início </label>
                    <input type="time" ng-model="horario_inicio" id="horario_inicio"  ng-model="horario_inicio" name="horario_inicio" class="form-control" required/>
    
                    <label for="horario_fim">Horário de Fim </label> 
                    <input type="time" ng-model="horario_fim" id="horario_fim"  ng-model="horario_fim" name="horario_fim" class="form-control" required/>
                </div>
            </div>
            

            <div class="row text-center">
                <button type="button" ng-click="salvarServico()" class="btn btn-primary">
                    Adicionar
                </button>
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