angular
    .module('viettut')
    .controller('CommentController', function ($auth, $http, $scope, $window, config, AuthenService) {
        $scope.comments = [];
        $scope.numberComments = 0;
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.commentContent = '';
        $scope.currentTutorial = false;
        $scope.commentToggle = false;

        $scope.reply = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            var data = {
                header: $scope.header,
                content: $scope.content,
                course: $scope.course.id
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post(config.BASE_URL + 'api/v1/chapters', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $window.location.reload();
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.$watch('comments', function(newVal, odlVal) {
            $scope.numberComments = newVal.length;
        });

        $scope.reloadComment = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            $http({
                method: 'GET',
                url: config.BASE_URL + 'api/v1/tutorials/' + $scope.currentTutorial + '/comments'
            }).then(function successCallback(response) {
                $scope.comments = response.data;
            }, function errorCallback(response) {
            });
        };

        $scope.$watch('currentTutorial', function(newVal, oldVal){
            if (typeof newVal == "number") {
                $scope.currentTutorial = newVal;
            }
        });

        $scope.addComment = function() {
            // start progress
            $scope.laddaLoading = true;
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            var data = {
                content: $scope.commentContent,
                tutorial: $scope.currentTutorial
            };

            $http.post(config.BASE_URL + 'api/v1/comments', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.reloadComment();
                        $scope.commentToggle = true;
                        $scope.commentContent = '';
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.isAuthenticated = $auth.isAuthenticated();
    });


