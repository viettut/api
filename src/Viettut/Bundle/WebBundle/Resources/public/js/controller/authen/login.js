/**
 * Created by giang on 21/02/2016.
 */
angular
    .module('viettut', ['ngSanitize', 'ladda', 'ngStorage', 'satellizer', 'ngAnimate'])
    .controller('LoginController', function ($auth, $scope, $localStorage, AuthenService) {
        $scope.$storage = $localStorage;
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;

        $scope.login = function() {
            // start progress
            $scope.laddaLoading = true;

            var credentials = {
                username: $scope.username,
                password: $scope.password
            };

            $auth.login(credentials).then(function(response) {
                $localStorage.username = response.data.username;
                $localStorage.name = response.data.username;
                $localStorage.avatar = response.data.avatar;
                AuthenService.goHome();
                $scope.laddaLoading = false;
            }).catch(function(data) {
                $scope.error = 'Invalid credentials';
                $scope.showError = true;
                $scope.laddaLoading = false;
            });
        };

        $scope.logout = function() {
            if(!$auth.isAuthenticated()) {
                return;
            }

            $auth.logout().then(function() {
                AuthenService.goHome();
            });
        };

        $scope.register = function() {
            AuthenService.register();
        };

        $scope.socialLogin = function(provider) {
            $auth.authenticate(provider)
                .then(function(response) {
                    AuthenService.goHome();
                })
                .catch(function(response) {
                    // Something went wrong.
                });
        };
    });