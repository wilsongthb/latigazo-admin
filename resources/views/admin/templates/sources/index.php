<h3 class="text-center">Fuentes</h3>

<p>
    <a href="" class="btn btn-primary" ng-click="createModal()">Nuevo</a>
</p>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>TITULO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="s in Sources.data">
            <td scope="row" ng-bind="s.id"></td>
            <td ng-bind="s.title"></td>
            <td>
                <a href="" class="btn btn-warning" ng-click="editModal(s)"><i class="fa fa-edit"></i> </a>
                <a href="" class="btn btn-danger" ng-click="deleteModal(s)"><i class="fa fa-trash"></i> </a>
            </td>
        </tr>
    </tbody>
</table>

<!-- Modal -->
<div
    class="modal fade" 
    id="create-source" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de Fuente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form ng-submit="Sources.save()">
                    <p>
                        <label for="">Titulo</label>
                        <input type="text" class="form-control" ng-model="Sources.reg.title" required>
                    </p>
                    <p>
                        <label for="">Descripcion</label>
                        <textarea class="form-control" rows="3" ng-model="Sources.reg.description"></textarea>
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
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div> -->
        </div>
    </div>
</div>