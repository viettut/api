angular
    .module('viettut')
    .controller('CourseController', function ($scope, config, CourseService, AlertService, RouteService) {
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
            RouteService.editCourse($scope.myCourses[courseIndex].token);
        };

        $scope.delete = function() {
            $scope.hideConfirm();
            
            if ($scope.deletingCourse == null) {
                return;
            }

            CourseService.deleteCourse($scope.myCourses[$scope.deletingCourse].id, function(response) {
                $scope.loading = false;
                if(response.status == 204) {
                    AlertService.info('div.blog-posts', 'The course has been deleted successfully!');
                    $scope.myCourses.splice($scope.deletingCourse, 1);
                }
            }, function(response){
                $scope.loading = false;
                AlertService.error('div.blog-posts', response.message);
            });
        };

        $scope.showConfirm = function(courseIndex) {
            $scope.deletingCourse = courseIndex;
            $('#deleteConfirm').modal('show');
        };

        $scope.hideConfirm = function() {
            $('#deleteConfirm').modal('hide');
        };

        CourseService.getMyCourses(function(response){
                $scope.loading = false;
                if (response.status == 200) {
                    $scope.myCourses = response.data;
                }
            },
            function(response){
                $scope.loading = false;
                AlertService.error('div.blog-posts', response.message);
            })
    });


