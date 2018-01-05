<!-- Modal -->
<div class="modal fade" id="add-input-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Entrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form ng-submit="Inputs.save()">
                    <p>
                        <label for="">Cantidad</label>
                        <div class="input-group">
                            <div class="input-group-prepend" ng-show="Inputs.reg.quantity">
                                <div class="input-group-text" ng-bind="Utils.money(Inputs.reg.quantity)"></div>
                            </div>
                            <input type="text" class="form-control" placeholder="0.00" required ng-model="Inputs.reg.quantity">
                        </div>
                    </p>
                    <p>
                        <label for="">Fuente</label>
                        <select class="form-control" ng-model="Inputs.reg.source_id" required>
                            <option ng-repeat="s in Sources.data" value="{{s.id}}" ng-bind="s.title"></option>
                        </select>
                    </p>
                    <p>
                        <label for="">Tipo</label>
                        <select ng-init="Inputs.reg.type_id = Inputs.reg.type_id || '1'" class="form-control" ng-model="Inputs.reg.type_id" required>
                            <option ng-repeat="(key, t) in Vals.inputs.types" value="{{key}}" ng-bind="t"></option>
                        </select>
                    </p>
                    <p>
                        <label for="">Observacion</label>
                        <textarea rows="4" class="form-control" ng-model="Inputs.reg.observation"></textarea>
                    </p>
                    <p>
                        <button type="submit" class="btn btn-primary">Guardar</button>
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