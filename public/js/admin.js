(function() {
    'use strict';

    angular.module('admin', [
        
    ]);
})();



(function() {
    'use strict';

    angular
        .module('admin')
        .controller('AdminController', AdminController);

    AdminController.$inject = ['$scope', '$http'];
    function AdminController($scope, $http) {
        var vm = this;
        
        // input service
        $scope.Inputs = {
            get: function(){
                $http.get(Vars.rsc + 'inputs', {
                    params: {area_id: 1}
                })
                .then(
                    res => {
                        this.data = res.data
                    }
                )
            }
        }

        $scope.Reasons = {
            get: function(){
                $http.get(Vars.rsc + 'reasons', {
                    params: {area_id: 1}
                })
                .then(
                    res => {
                        this.data = res.data
                    }
                )
            }
        }

        $scope.Outputs = {
            get: function(){
                $http.get(Vars.rsc + 'outputs', {
                    params: {area_id: 1}
                })
                .then(
                    res => {
                        this.data = res.data
                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.Inputs.get()
            $scope.Outputs.get()
            $scope.Reasons.get()
        }
    }
})();