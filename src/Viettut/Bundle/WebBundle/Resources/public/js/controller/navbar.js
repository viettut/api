angular
    .module('viettut')
    .controller('NavBarController', function ($scope, $auth, $window, $localStorage, AuthenService) {
        $scope.username = $localStorage.username;
        $scope.name = $localStorage.name;
        $scope.avatar = $localStorage.avatar;
        $scope.professional = '';
        $scope.register = function() {
            AuthenService.register();
        };

        $scope.login = function() {
            AuthenService.login();
        };

        $scope.logout = function(){
            if (!$auth.isAuthenticated()) { return; }
            $auth
                .logout()
                .then(function() {
                    AuthenService.goHome();
                });
        };

        $scope.isAuthenticated = function() {
            return $auth.isAuthenticated();
        };

        $scope.isOnUserPage = function(){
            return ($window.location.href.toString().match('/\/register') || $window.location.href.toString().match('/\/login'));
        };
    });
