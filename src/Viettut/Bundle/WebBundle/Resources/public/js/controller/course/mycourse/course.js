angular
    .module('viettut')
    .controller('CourseController', function ($http, $scope, $window, config) {
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
            $scope.hideConfirm();
            
            if ($scope.deletingCourse == null) {
                return;
            }

            $http.delete(config.API_URL + 'courses/' + $scope.myCourses[$scope.deletingCourse].id).
            then(
                function(response){
                    $scope.loading = false;
                    if(response.status == 204) {
                        $scope.addInfo('The course has been deleted successfully!');
                        $scope.myCourses.splice($scope.deletingCourse, 1);
                    }
                },
                function(response){
                    $scope.loading = false;
                    $scope.addError(response.message);
                });
        };

        $scope.showConfirm = function(courseIndex) {
            $scope.deletingCourse = courseIndex;
            $('#deleteConfirm').modal('show');
        };

        $scope.hideConfirm = function() {
            $('#deleteConfirm').modal('hide');
        };

        $scope.loadCourses = function() {
            $http.get(config.API_URL + 'mycourses').
            then(
                function(response){
                    $scope.loading = false;
                    if (response.status == 200) {
                        $scope.myCourses = response.data;
                    }
                },
                function(response){
                    $scope.loading = false;
                    $scope.addError(response.message);
                });
        };

        $scope.loadCourses();

        $scope.addError = function(message) {
            var html = '<div class="alert alert-danger alert-dismissable">' +
                '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                message +
                '</div>';
            angular.element($('div.blog-posts')).before(html);
        };

        $scope.addInfo = function(message) {
            var html = '<div class="alert alert-success alert-dismissable">' +
                '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                message +
                '</div>';
            angular.element($('div.blog-posts')).before(html);
        };
    });


