
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administracion</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <h1 class="text-center">Administracion</h1>

        
        <div class="container" ng-app="admin" ng-controller="AdminController">
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <div class="form-group">
                               <h3>ENTRADAS</h3>
                               <table class="table table-hover">
                                   <thead>
                                       <tr>
                                           <th>ID</th>
                                           <th>FUENTE</th>
                                           <th>CANTIDAD</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr ng-repeat="i in Inputs.data">
                                           <td ng-bind="i.id"></td>
                                           <td ng-bind="i.source"></td>
                                           <td ng-bind="i.quantity"></td>
                                       </tr>
                                   </tbody>
                               </table>
                               
                           </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
                               
                               <h3>SALIDA</h3>
                               <div class="form-group">
                                   
                                   <a class="btn btn-primary" data-toggle="modal" href='#create_otuput'>Create</a>
                                   <div class="modal fade" id="create_otuput">
                                       <div class="modal-dialog">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                   <h4 class="modal-title">Modal title</h4>
                                               </div>
                                               <div class="modal-body">
                                                   <form action="">
                                                       <div class="form-group">
                                                           <label for=""></label>
                                                            <div class="list-group">
                                                                <a href="#" class="list-group-item" ng-repeat="r in Reasons.data">
                                                                    <span class="badge">@{{r.budget.max}} | @{{r.max}} </span> @{{r.title}}
                                                                </a>
                                                            </div>
                                                       </div>
                                                   </form>
                                               </div>
                                               <!-- <div class="modal-footer">
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                   <button type="button" class="btn btn-primary">Save changes</button>
                                               </div> -->
                                           </div>
                                       </div>
                                   </div>
                                   
                               </div>
                               
                               <table class="table table-hover">
                                   <thead>
                                       <tr>
                                           <th>ID</th>
                                           <th>RAZON</th>
                                           <th>CANTIDAD</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr ng-repeat="o in Outputs.data">
                                           <td ng-bind="o.id"></td>
                                           <td ng-bind="o.reason"></td>
                                           <td ng-bind="o.quantity"></td>
                                       </tr>
                                   </tbody>
                               </table>
                               
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </div>
        

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script>
        const Vars = {
            url: '{!! url('') !!}',
            rsc: '{!! url('rsc') !!}/',
            config: {!! json_encode(config('admin.config')) !!}
        }
        </script>
        <script src="{{asset('node_modules/angular/angular.js')}}"></script>
        <script src="{{asset('js/admin.js')}}"></script>
    </body>
</html>
