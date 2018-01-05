//MODULE
(function() {
    'use strict';

    angular.module('admin', [
        'ngRoute'
    ]);
})();

//ROUTES
(function() {
    'use strict';
    angular.module('admin')
        .config([
            '$routeProvider',
            '$locationProvider',
            function Config($routeProvider, $locationProvider){
                $locationProvider.html5Mode(true);
                $routeProvider
                    .when('/', {
                        template: '<h1>HOLA ESTE ES UN SISTEMA ADMINISTRATIVO</h1>'
                    })
                    .when('/main', {
                        templateUrl: `${Vals.urlViews}/main`,
                        controller: 'MainController'
                    })
                    .when('/sources', {
                        templateUrl: `${Vals.urlViews}/sources.index`,
                        controller: 'SourcesController'
                    })
                    .when('/reasons', {
                        templateUrl: `${Vals.urlViews}/reasons.index`,
                        controller: 'ReasonsController'
                    })
                    // .when('/admin', {
                    //     templateUrl: `${Vals.urlViews}/index`,
                    //     controller: 'AdminController'
                    // })
            }
        ]);
})();

//SERVICES
(function() {
    'use strict';

    angular
        .module('admin')
        .factory('Sources', Sources);

    Sources.$inject = ['$http', 'Areas', 'Utils'];
    function Sources($http, Areas, Utils) {
        var service = {
            exposedFn:exposedFn,
            reg: {},
            get: function(){
                $http.get(Vals.rsc + 'sources')
                .then(
                    res => {
                        this.data = Utils.idToStr(res.data)
                    }
                )
            },
            save: function(){
                if(!this.reg.id){
                    $http.post(Vals.rsc + 'sources', this.reg)
                    .then(
                        res => {
                            this.get()
                        }
                    )
                }else{
                    $http.put(Vals.rsc + 'sources/' + this.reg.id, this.reg)
                    .then(
                        res => {
                            this.get()
                        }
                    )
                }
                this.init()
                
            },
            init: function(){
                this.reg = {
                    area_id: Areas.getId()
                }
                // this.get()
            },
            delete: function(id){
                $http.delete(Vals.rsc + 'sources/' + id)
                .then(
                    res => {
                        this.get()
                    }
                )
            }
        };

        return service;

        ////////////////
        function exposedFn() { }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .factory('Users', Users);

    Users.$inject = ['$http', 'Utils'];
    function Users($http, Utils) {
        var service = {
            exposedFn:exposedFn,
            get: function(){
                $http.get(Vals.rsc + 'users')
                .then(
                    res => {
                        // this.data = res.data
                        this.data = Utils.idToStr(res.data)
                    }
                )
            }
        };
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .factory('Budgets', Budgets);

    Budgets.$inject = ['$http'];
    function Budgets($http) {
        var service = {
            exposedFn:exposedFn,
            get: function(reason_id){
                $http.get(Vals.rsc + 'budgets', {params: {reason_id}})
                .then(
                    res => {
                        this.data = res.data
                    }
                )
            },
            new: function(reason_id, max, cb = false){
                $http.post(Vals.rsc + 'budgets', {
                    reason_id,
                    max
                }).then(
                    res => {
                        this.get(reason_id)
                        if(cb) cb();
                    }
                )
            }
        };
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .factory('Reasons', Reasons);

    Reasons.$inject = ['$http', 'Areas', 'Utils'];
    function Reasons($http, Areas, Utils) {
        var service = {
            exposedFn:exposedFn,
            get: function(){
                $http.get(Vals.rsc + 'reasons', {
                    // params: {area_id: Areas.area.id}
                })
                .then(
                    res => {
                        // this.data = res.data
                        this.data = Utils.idToStr(res.data)
                    }
                )
            },
            save: function(){
                // console.log('ajajaja')
                if(!this.reg.id){
                    $http.post(Vals.rsc + 'reasons', this.reg)
                    .then(
                        res => {
                            this.get()
                            this.reg = res.data
                            // Budgets.get(res.data.id)
                        }
                    )
                }else{
                    $http.put(Vals.rsc + 'reasons/' + this.reg.id, this.reg)
                    .then(
                        res => {
                            this.get()
                        }
                    )
                }
                // this.reg = {}
            },
            delete: function(id){
                $http.delete(Vals.rsc + 'reasons/' + id)
                .then(
                    res => {
                        this.get()
                    }
                )
            },
            getOne: function(reason_id, cb){
                $http.get(Vals.rsc + 'reasons/' + reason_id)
                .then(
                    res => {
                        cb(res.data)
                    }
                )
            }
        };
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .factory('Utils', Utils);

    Utils.$inject = ['$http'];
    function Utils($http) {
        var service = {
            exposedFn:exposedFn,
            money: function(d){
                return moneyFormatter.format(Vals.config.money, d)
            },
            idToStr: function(arr_res){
                var arr = []
                for(var i in arr_res){
                    var fila = arr_res[i]
                    fila.id = fila.id.toString()
                    arr.push(fila)
                }
                return arr
                // console.log(arr)
            }
        };
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .factory('Areas', Areas);

    Areas.$inject = ['$http', '$route', 'Utils'];
    function Areas($http, $route, Utils) {
        var service = {
            area: {},
            exposedFn:exposedFn,
            setArea: function(){
                $http.put(Vals.rsc + 'areas/set-area', { area_id: this.area.id })
                .then(
                    res => {
                        $route.reload()
                    }
                )
            },
            getArea: function(){
                $http.put(Vals.rsc + 'areas/get-area')
                .then(
                    res => {
                        if(res.data.length !== 0){
                            this.area = res.data
                            localStorage.area_id = res.data.id
                        }
                    }
                )
            },
            getId: function(){
                // return parseInt(this.area.id)
                return this.area.id
            },
            get: function(){
                $http.get(Vals.rsc + 'areas')
                .then(
                    res => {
                        this.data = res.data
                        // this.data = Utils.idToStr(res.data)
                    }
                )
            },
            save: function(){
                console.log('save')
                $http.post(Vals.rsc + 'areas', this.reg)
                .then(
                    res => {
                        this.reg = {}
                        this.get()
                    }
                )
            },
            edit: function(a){
                console.log('edit')
                $http.put(Vals.rsc + 'areas/' + a.id, a)
                .then(
                    res => this.get()
                )
            },
            delete: function(id){
                console.log('delete')
                $http.delete(Vals.rsc + 'areas/' + id)
                .then(
                    res => this.get()
                )
            }
        };

        service.area.id = localStorage.area_id
        service.getArea();
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .factory('Inputs', Inputs);

    Inputs.$inject = ['$http', 'Areas', 'Utils'];
    function Inputs($http, Areas, Utils) {
        var service = {
            exposedFn:exposedFn,
            save: function(){
                $http.post(Vals.rsc + 'inputs', this.reg)
                .then(
                    res => {
                        
                        this.get()
                    }
                )
                this.reg = {}
            },
            get: function(){
                $http.get(Vals.rsc + 'inputs', {
                    params: {
                        // area_id: Areas.area.id,
                        today: true
                    }
                })
                .then(
                    res => {
                        // this.data = res.data
                        this.data = Utils.idToStr(res.data)
                    }
                )
            },
            delete: function(input_id){
                $http.delete(Vals.rsc + 'inputs/' + input_id)
                .then(
                    res => this.get()
                )
            }
        };
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .factory('Outputs', Outputs);

    Outputs.$inject = ['$http', 'Utils'];
    function Outputs($http, Utils) {
        var service = {
            exposedFn:exposedFn,
            get: function(){
                $http.get(Vals.rsc + 'outputs', {
                    params: {today: true}
                })
                .then(
                    res => {
                        // this.data = res.data
                        this.data = Utils.idToStr(res.data)
                    }
                )
            },
            save: function(){
                this.reg.reason = null
                $http.post(Vals.rsc + 'outputs', this.reg)
                .then(
                    res => this.get()
                )
                this.reg = {}
            },
            delete: function(output_id){
                $http.delete(Vals.rsc + 'outputs/' + output_id)
                .then(
                    res => this.get()
                )
            }
        };
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})();
//ENDSERVICES

//CONTROLLERS
(function() {
    'use strict';

    angular
        .module('admin')
        .controller('MainController', MainController);

    MainController.$inject = ['$scope', 'Utils', '$http', 'Inputs', 'Reasons', 'Sources', 'Outputs'];
    function MainController($scope, Utils, $http, Inputs, Reasons, Sources, Outputs) {
        var vm = this;
        $scope.Utils = Utils
        $scope.Vals = Vals
        $scope.Inputs = Inputs
        $scope.Outputs = Outputs
        $scope.Reasons = Reasons
        $scope.Sources = Sources

        $scope.loadReason = function(reason_id){
            $scope.Reasons.getOne(reason_id, function(reason){
                $scope.Outputs.reg.reason = reason
            })
        }
        $scope.dialogInDel = function(input_id){
            if(confirm('Anular? ' + input_id)){
                $scope.Inputs.delete(input_id)
            }
        }
        $scope.dialogOutDel = function(output_id){
            if(confirm('Anular? ' + output_id)){
                $scope.Outputs.delete(output_id)
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.Sources.get()
            $scope.Inputs.get()
            $scope.Outputs.get()
            $scope.Reasons.get()
        }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .controller('AreasController', AreasController);

    AreasController.$inject = ['$scope', '$http', 'Areas'];
    function AreasController($scope, $http, Areas) {
        var vm = this;

        $scope.dialogDelete = function(a){
            if(confirm('Eliminar a ' + a.id + ' - ' + a.name)){
                $scope.Areas.delete(a.id)
            }
        }
        $scope.hideModalAreas = function(){
            console.log('ajaj')
            $('#areas-modal').modal('hide')
            // $scope.Areas.setArea()
            setTimeout(() => {
                $scope.Areas.setArea()
            }, 500);
        }

        $scope.Areas = Areas

        activate();

        ////////////////

        function activate() { 
            $scope.Areas.get()
        }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .controller('SourcesController', SourcesController);

    SourcesController.$inject = ['$scope', 'Sources', 'Areas'];
    function SourcesController($scope, Sources, Areas) {
        var vm = this;
        $scope.Sources = Sources
        $scope.Areas = Areas

        $scope.createModal = function(){
            Sources.init()
            $('#create-source').modal('show')
        }
        $scope.editModal = function(s){
            Sources.reg = s
            $('#create-source').modal('show')
        }
        $scope.deleteModal = function(s){
            if(confirm('Borrar el registro? ' + s.id)){
                Sources.delete(s.id)
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.Sources.get()
            $scope.Sources.init()
            $scope.Areas.get()
        }
    }
})();
(function() {
    'use strict';

    angular
        .module('admin')
        .controller('ReasonsController', ReasonsController);

    ReasonsController.$inject = ['$scope', 'Reasons', 'Users', 'Budgets', 'Utils'];
    function ReasonsController($scope, Reasons, Users, Budgets, Utils) {
        var vm = this;
        $scope.Reasons = Reasons
        $scope.Budgets = Budgets
        $scope.Utils = Utils
        $scope.Users = Users

        $scope.createModal = function(){
            $scope.Reasons.reg = {}
            $('#create-reason').modal('show')
        }
        $scope.editModal = function(s){
            Reasons.reg = s
            Budgets.get(s.id)
            $('#create-reason').modal('show')
        }
        $scope.deleteModal = function(s){
            if(confirm('Borrar el registro? ' + s.id)){
                Reasons.delete(s.id)
            }
        }
        $scope.reloadReasons = function(){
            $scope.Reasons.get()
        }

        activate();

        ////////////////

        function activate() { 
            $scope.Reasons.get()
            Users.get()
        }
    }
})();

// //DESUSO
// (function() {
//     'use strict';

//     angular
//         .module('admin')
//         .controller('AdminController', AdminController);

//     AdminController.$inject = ['$scope', '$http'];
//     function AdminController($scope, $http) {
//         var vm = this;
        
//         // input service
//         $scope.Inputs = {
//             get: function(){
//                 $http.get(Vals.rsc + 'inputs', {
//                     params: {area_id: 1}
//                 })
//                 .then(
//                     res => {
//                         this.data = res.data
//                     }
//                 )
//             }
//         }

//         $scope.Reasons = {
//             get: function(){
//                 $http.get(Vals.rsc + 'reasons', {
//                     params: {area_id: 1}
//                 })
//                 .then(
//                     res => {
//                         this.data = res.data
//                     }
//                 )
//             }
//         }

//         $scope.Outputs = {
//             get: function(){
//                 $http.get(Vals.rsc + 'outputs', {
//                     params: {area_id: 1}
//                 })
//                 .then(
//                     res => {
//                         this.data = res.data
//                     }
//                 )
//             }
//         }

//         activate();

//         ////////////////

//         function activate() { 
//             $scope.Inputs.get()
//             $scope.Outputs.get()
//             $scope.Reasons.get()
//         }
//     }
// })();
