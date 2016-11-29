angular
    .module('viettut')
    .controller('ChapterController', function ($auth, $http, $scope, $window, config, AuthenService) {
        $scope.previewText = 'Show Preview';
        $scope.showPreview = false;
        $scope.header = '';
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.courseId = angular.element($('#courseId')).text();
        $scope.introduce = $('textarea#introduce').val();

        $scope.getCourse = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $http({
                method: 'GET',
                url: config.API_URL + 'courses/' + $scope.courseId
            }).then(function successCallback(response) {
                $scope.course = responses.data;
            }, function errorCallback(response) {
            });

            console.log($scope.course.id);
        };

        $scope.$watch('courseId', function(newVal, oldVal){
            $scope.courseId = newVal;
            $scope.getCourse();
        });

        $scope.add = function(){
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            var data = {
                header: $scope.header,
                content: $scope.content,
                course: $scope.courseId
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post(config.API_URL + 'chapters', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.addAnotherChapter();
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

        $scope.goHome = function() {
            AuthenService.goHome();
        };

        $scope.addAnotherChapter = function(){
            $window.location.reload();
        };

        $scope.preview = function(){
            $scope.showPreview = !$scope.showPreview;

            if($scope.showPreview) {
                $scope.previewText = 'Hide Preview';
            }
            else $scope.previewText = 'Show Preview';
        };

        $scope.isAuthenticated = $auth.isAuthenticated();
    });


