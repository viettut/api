angular
    .module('viettut')
    .controller('FooterController', function ($scope, $http, config) {
        $scope.email = '';
        $scope.subscribeFail = false;
        $scope.subscribeSuccess = false;
        $scope.invalidEmail = false;


        $scope.subscribe = function() {
            $scope.invalidEmail = false;
            var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
            if (!pattern.test($scope.email)) {
                $scope.invalidEmail = true;
                $scope.email = '';
                return false;
            }

            // start progress
            angular.element('#subscribeButton').button('loading');
            var data = {
                email: $scope.email
            };

            $http.post(config.PUBLIC_API_URL + 'subscribe', data).
                then(
                function(response){
                    angular.element('#subscribeButton').button('reset');
                    if(response.status == 200) {
                        $scope.subscribeSuccess = true;
                    }
                },
                function(response){
                    $scope.subscribeFail = true;
                    angular.element('#subscribeButton').button('reset');
                });
        };
    });

