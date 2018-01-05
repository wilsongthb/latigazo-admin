
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administracion</title>

        <!-- Bootstrap CSS -->
        <link href="{{asset('node_modules/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('node_modules/font-awesome/css/font-awesome.min.css')}}">
        <base href="{{url('admin')}}/">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div ng-app="admin">
            <ul>
                <li><a href="{{url('/')}}">/</a></li>
                <li><a href="{{url('admin/main')}}">main</a></li>
                <li><a href="{{url('admin/sources')}}">sources</a></li>
                <li><a href="{{url('admin/reasons')}}">reasons</a></li>
            </ul>
            
            <div class="container">
                <div class="row">
                    <div class="col-xl">
                        <ng-view></ng-view>
                    </div>
                    
                </div>
            </div>
        </div>
        

        <!-- Popper -->
        <!-- <script src="{{asset('node_modules/popper.js/dist/popper.js')}}"></script> -->
        <!-- jQuery -->
        <script src="{{asset('node_modules/jquery/dist/jquery.js')}}"></script>
        <!-- Bootstrap JavaScript -->
        <script src="{{asset('node_modules/bootstrap/dist/js/bootstrap.js')}}"></script>

        <script>
        const Vals = {
            url: "{!! url('') !!}",
            urlViews: "{!! url('views') !!}",
            rsc: "{!! url('rsc') !!}/",
            admin: JSON.parse('{!! json_encode(config("admin")) !!}'),
            inputs: JSON.parse('{!! json_encode(config("admin.inputs")) !!}'),
            config: JSON.parse('{!! json_encode(config("admin.config")) !!}')
            // config: {!! json_encode(config('admin.config')) !!}
        };
        </script>
        <script src="{{asset('node_modules/money-formatter/dist/money-formatter.min.js')}}"></script>
        <script src="{{asset('node_modules/angular/angular.js')}}"></script>
        <script src="{{asset('node_modules/angular-route/angular-route.js')}}"></script>
        <script src="{{asset('js/admin.js')}}"></script>
    </body>
</html>
