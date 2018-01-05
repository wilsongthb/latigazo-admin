
<!-- Modal -->
<div
    class="modal fade" 
    id="areas-modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Areas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" ng-controller="AreasController">
                <a href="" ng-click="edit = 'editar'">a</a>
                <form ng-submit="Areas.save()">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="form-control" type="text" ng-model="Areas.reg.name" required>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                </td>
                            </tr>
                            <tr ng-repeat="a in Areas.data">
                                <td scope="row" ng-bind="a.id"></td>
                                <td>
                                    <span ng-switch="a._edit">
                                        <span ng-switch-default ng-bind="a.name"></span>
                                        <input class="form-control" ng-switch-when="editar" type="text" ng-model="a.name">
                                    </span>
                                </td>
                                <td>
                                    <span ng-switch="a._edit">
                                        <a ng-switch-default href="" class="btn btn-primary" ng-click="a._edit = 'editar'"><i class="fa fa-edit"></i> </a>
                                        <a ng-switch-when="editar" href="" class="btn btn-success" ng-click="Areas.edit(a)"><i class="fa fa-save"></i> </a>
                                        <a ng-switch-default href="" class="btn btn-danger" ng-click="dialogDelete(a)"><i class="fa fa-trash"></i> </a>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <p>
                    <label for="">Area Seleccionada</label>
                    <!-- <select ng-model="Areas.area.id" ng-change="hideModalAreas()" class="form-control">
                        <option ng-repeat="a in Areas.data" value="{{parseInt(a.id)}}" ng-bind="a.name"></option>
                    </select> -->
                    <select 
                        ng-model="Areas.area.id" 
                        ng-change="hideModalAreas()" 
                        ng-options="a.id as a.name for a in Areas.data"
                        class="form-control"></select>
                </p>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div> -->
        </div>
    </div>
</div>