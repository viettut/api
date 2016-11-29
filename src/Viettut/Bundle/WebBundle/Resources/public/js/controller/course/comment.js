angular
    .module('viettut')
    .controller('CommentController', function CommentController($auth, $http, $scope, $window, AuthenService, config) {
        $scope.comments = [];
        $scope.numberComments = 0;
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.commentToggle = false;
        $scope.currentCourse = false;

        $scope.showReplyForm = function() {

        };

        $scope.reply = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            var data = {
                header: $scope.header,
                content: $scope.content,
                course: $scope.course.id
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post(config.API_URL + 'chapters', data).
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

        $scope.reloadComment = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            $http({
                method: 'GET',
                url: config.API_URL + 'courses/' + $scope.currentCourse + '/comments'
            }).then(function successCallback(response) {
                $scope.comments = response.data;
                $scope.numberComments = $scope.comments.length;

            }, function errorCallback(response) {
            });
        };

        $scope.$watch('currentCourse', function(newVal, oldVal){
            if (typeof newVal == "number") {
                $scope.currentCourse = newVal;
            }
        });

        $scope.addComment = function() {
            // start progress
            $scope.laddaLoading = true;
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            var data = {
                content: $scope.content,
                course: $scope.currentCourse
            };

            $http.post(config.API_URL + 'comments', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.reloadComment();
                        $scope.commentToggle = true;
                        $scope.content = '';
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


