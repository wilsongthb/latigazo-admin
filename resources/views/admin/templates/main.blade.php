<h1 class="text-center">LATIGAZO ADMIN</h1>

<p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#areas-modal">
        Areas
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sources-modal">
        Fuentes
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-input-modal">
        Ingresar
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reasons-modal">
        Razones
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-output-modal">
        Registrar Salida
    </button>
</p>

<div class="row">
    <div class="col-lg-6">
        <h3>ENTRADAS</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fuente</th>
                    <th class="text-right">Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="i in Inputs.data">
                    <td ng-bind="i.id"></td>
                    <td ng-bind="i.source"></td>
                    <td class="text-right" ng-bind="Utils.money(i.quantity)"></td>
                    <td>
                        
                        <span ng-switch="i.enable">
                            <span ng-switch-when="0">Anulado</span>
                            <i ng-switch-when="1" ng-click="dialogInDel(i.id)" class="fa fa-trash"></i>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <h3>SALIDAS</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Razon</th>
                    <th>Autorizacion</th>
                    <th class="text-right">Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="o in Outputs.data">
                    <td ng-bind="o.id"></td>
                    <td ng-bind="o.reason"></td>
                    <td>
                        <span ng-switch="o.require_authorizer">
                            <span ng-switch-when="0">
                                No requiere
                            </span>
                            <span ng-switch-when="1" ng-switch="o.authorized">
                                <span ng-switch-when="1">Autorizado</span>
                                <span ng-switch-when="0">No Autorizado</span>
                            </span>
                        </span>
                    </td>
                    <td class="text-right" ng-bind="Utils.money(o.quantity)"></td>
                    <td>
                        <span ng-switch="o.enable">
                            <span ng-switch-when="0">Anulado</span>
                            <i ng-switch-when="1" ng-click="dialogOutDel(o.id)" class="fa fa-trash"></i>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('admin.modal_input')
@include('admin.modal_areas')
@include('admin.modal_sources')
@include('admin.modal_output')
@include('admin.modal_reasons')
