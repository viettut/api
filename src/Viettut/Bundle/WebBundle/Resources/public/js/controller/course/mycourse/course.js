angular
    .module('viettut')
    .controller('CourseController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, AuthenService, config) {
        $scope.myCourses = [];
        $scope.loading = true;
        $scope.deletingCourse = null;

        $scope.getFirstParagraph = function(str) {
            return str.substring(0, str.indexOf("\n"));
        };

        $scope.buildViewLink = function(course) {
            return config.BASE_URL + course.author.username + '/courses/' + course.hashTag;
        };

        $scope.edit = function(courseIndex) {
            $window.location.href = config.BASE_URL + 'courses/' + $scope.myCourses[courseIndex].token + '/edit';
        };

        $scope.delete = function() {
            if ($scope.deletingCourse == null) {
                return;
            }

            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $http.delete(config.API_URL + 'courses/' + $scope.myCourses[$scope.deletingCourse].id).
            then(
                function(response){
                    $scope.loading = false;
                    if(response.status == 204) {
                        $scope.hideConfirm();
                        $scope.alertSuccess();
                        $scope.myCourses.splice($scope.deletingCourse, 1);
                    }
                },
                function(response){
                    $scope.loading = false;
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }
                });
        };

        $scope.showConfirm = function(courseIndex) {
            $scope.deletingCourse = courseIndex;
            $('#deleteConfirm').modal('show');
        };

        $scope.hideConfirm = function() {
            $('#deleteConfirm').modal('hide');
        };

        $scope.isAuthenticated = $auth.isAuthenticated();

        $scope.alertSuccess = function() {
            var html = '<div class="alert alert-success">' +
                '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                '    <strong>Good job!</strong> The course has been deleted successfully !' +
                '</div>';
            angular.element($('div.blog-posts')).before(html);
        };

        $scope.loadCourses = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $http.get(config.API_URL + 'mycourses').
            then(
                function(response){
                    $scope.loading = false;
                    if(response.status == 200) {
                        $scope.myCourses = response.data;

                    }
                },
                function(response){
                    $scope.loading = false;
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }
                });
        };

        $scope.loadCourses();
    });


