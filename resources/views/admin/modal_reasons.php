<!-- Modal -->
<div
    class="modal fade" 
    id="reasons-modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Razones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TITULO</th>
                            <th>GASTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="s in Reasons.data">
                            <td scope="row" ng-bind="s.id"></td>
                            <td ng-bind="s.title"></td>
                            <td ng-bind="s.total"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div> -->
        </div>
    </div>
</div>