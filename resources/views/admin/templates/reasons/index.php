<h3 class="text-center">Razones</h3>

<p>
    <a href="" class="btn btn-primary" ng-click="createModal()">Nuevo</a>
</p>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>TITULO</th>
            <th>AUTORIZACION</th>
            <th class="text-right">PRESUPUESTO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="r in Reasons.data">
            <td scope="row" ng-bind="r.id"></td>
            <td ng-bind="r.title"></td>
            <td>
                <span ng-switch="r.require_authorizer">
                    <span ng-switch-when="0">No Requerida</span>
                    <span ng-switch-when="1">Requerida por <span ng-bind="r.authorizer.name"></span></span>
                </span>
            </td>
            <td class="text-right">
                <span ng-switch="r.free">
                    <span ng-switch-when="1">Libre</span>
                    <span ng-switch-when="0">
                        <p>{{Utils.money(r.max)}}</p>
                        <span ng-show="r.budget.max">{{Utils.money(r.budget.max)}}</span>
                    </span>
                </span>
            </td>
            <td>
                <a href="" class="btn btn-warning" ng-click="editModal(r)"><i class="fa fa-edit"></i> </a>
                <a href="" class="btn btn-danger" ng-click="deleteModal(r)"><i class="fa fa-trash"></i> </a>
            </td>
        </tr>
    </tbody>
</table>


<!-- Modal -->
<div
    class="modal fade" 
    id="create-reason" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
    <div class="modal-dialog" ng-class="{ 'modal-lg': Reasons.reg.id }" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de Razones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md" ng-class="{ 'col-md-6': Reasons.reg.id }">
                        <form ng-submit="Reasons.save()">
                            <p>
                                <label for="">Titulo</label>
                                <input type="text" class="form-control" ng-model="Reasons.reg.title" required>
                            </p>
                            <p>
                                <label for="">Descripcion</label>
                                <textarea class="form-control" rows="3" ng-model="Reasons.reg.description"></textarea>
                            </p>
                            <p>
                                <label for="">Requiere Autorizacion</label>
                                <p>
                                    <input type="radio" ng-model="Reasons.reg.require_authorizer" value="1"> Si
                                </p>
                                <p>
                                    <input type="radio" ng-model="Reasons.reg.require_authorizer" value="0"> No
                                </p>
                            </p>
                            <p ng-if="Reasons.reg.require_authorizer == '1'">
                                <label for="">Autorizador</label>
                                <!-- <select class="form-control" required ng-model="Reasons.reg.authorizer">
                                    <option ng-repeat="u in Users.data" value="{{u.id}}" ng-bind="u.name"></option>
                                </select> -->
                                <select 
                                    class="form-control" 
                                    required 
                                    ng-model="Reasons.reg.authorizer_id"
                                    ng-options="u.id as u.name for u in Users.data"></select>
                            </p>
                            <p>
                                <label for="">Presupuesto Libre</label>
                                <p>
                                    <input type="radio" ng-model="Reasons.reg.free" value="1"> Si
                                </p>
                                <p>
                                    <input type="radio" ng-model="Reasons.reg.free" value="0"> No
                                </p>
                            </p>
                            <!-- <p>
                                <label for="">Area</label>
                                <select class="form-control" ng-model="Sources.reg.area_id" required>
                                    <option ng-repeat="a in Areas.data" value="{{a.id}}" ng-bind="a.name"></option>
                                </select>
                            </p> -->
                            <p>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </p>
                        </form>
                    </div>
                    <div class="col-md-6" ng-if="Reasons.reg.id">
                        <form ng-show="Reasons.reg.free == false" ng-submit="Budgets.new(Reasons.reg.id, Reasons.reg.lastBudget, reloadReasons())">
                            <p>
                                <label for="">Nuevo Presupuesto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend" ng-show="Reasons.reg.lastBudget">
                                        <div class="input-group-text" ng-bind="Utils.money(Reasons.reg.lastBudget)"></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="0.00" required ng-model="Reasons.reg.lastBudget">
                                </div>
                            </p>
                            <p>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </p>
                        </form>
                        <h4>Lista de Presupuesto Anteriores</h4>
                        <div class="alert alert-primary" role="alert" ng-show="Reasons.reg.free == '1'">
                            Presupueso libre :D
                        </div>
                        <table class="table" ng-show="Budgets.data.length > 0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="b in Budgets.data">
                                    <td scope="row" ng-bind="b.id"></td>
                                    <td class="text-right" ng-bind="Utils.money(b.max)"></td>
                                    <td ng-bind="b.created_at"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div> -->
        </div>
    </div>
</div>