
<!-- Modal -->
<div
    class="modal fade" 
    id="add-output-modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SALIDA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form ng-submit="Outputs.save()">
                    <p>
                        <label for="">Salida</label>
                        <select 
                            class="form-control" 
                            ng-init="Outputs.reg.type_id = Outputs.reg.type_id || '1'"
                            ng-model="Outputs.reg.type_id" 
                            ng-options="key as a for (key, a) in Vals.admin.outputs.types"></select>
                    </p>
                    <p>
                        <label for="">Razon</label>
                        <select 
                            ng-model="Outputs.reg.reason_id" 
                            ng-change="loadReason(Outputs.reg.reason_id)"
                            class="form-control"
                            required 
                            ng-options="r.id as r.title for r in Reasons.data"></select>
                    </p>
                    <p ng-show="Outputs.reg.reason_id">
                        <label for="">Maximo</label>
                        <div ng-switch="Outputs.reg.reason.free">
                            <div ng-switch-when="1" class="alert alert-primary">
                                Presupuesto Libre :D
                            </div>
                            <div ng-switch-when="0" class="alert alert-warning">
                                {{Utils.money(Outputs.reg.reason.max)}}
                            </div>
                        </div>
                    </p>
                    <p ng-show="Outputs.reg.reason_id">
                            <label for="">Requiere Autorizacion</label>
                            <div ng-switch="Outputs.reg.reason.require_authorizer">
                                <div ng-switch-when="1" class="alert alert-info">
                                    Requiere autorizacion de {{Outputs.reg.reason.authorizer.name}}
                                </div>
                                <div ng-switch-when="0" class="alert alert-success">
                                    No requiere Autorizacion
                                </div>
                            </div>
                        </p>
                    <p>
                        <label for="">Cantidad</label>
                        <div class="input-group">
                            <div class="input-group-prepend" ng-show="Outputs.reg.quantity">
                                <div class="input-group-text" ng-bind="Utils.money(Outputs.reg.quantity)"></div>
                            </div>
                            <input type="text" class="form-control" placeholder="0.00" required ng-model="Outputs.reg.quantity">
                        </div>
                    </p>
                    <p>
                        <label for="">Observacion</label>
                        <textarea rows="4" class="form-control" ng-model="Outputs.reg.observation"></textarea>
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
