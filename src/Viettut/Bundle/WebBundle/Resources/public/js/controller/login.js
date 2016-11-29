angular
    .module('viettut')
    .controller('LoginController', function ($auth, $scope, $localStorage, $window, AuthenService, config) {
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
                console.log('user -> ' + JSON.stringify(response));
                $window.location.href = config.BASE_URL;
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
