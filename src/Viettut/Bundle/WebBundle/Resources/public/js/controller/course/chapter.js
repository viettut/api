angular
    .module('viettut')
    .controller('ChapterController', function ($scope, CourseService, ChapterService, RouteService, AlertService) {
        $scope.previewText = 'Show Preview';
        $scope.showPreview = false;
        $scope.header = '';
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.courseId = angular.element($('#courseId')).text();
        $scope.introduce = $('textarea#introduce').val();

        $scope.getCourse = function() {
            CourseService.getCourse($scope.courseId, 
                function successCallback(response) {
                    $scope.course = response.data;
                }, function errorCallback(response) {
                }
            );
        };

        $scope.$watch('courseId', function(newVal, oldVal){
            $scope.courseId = newVal;
            $scope.getCourse();
        });

        $scope.add = function(){
            var data = {
                header: $scope.header,
                content: $scope.content,
                course: $scope.courseId
            };

            // start progress
            $scope.laddaLoading = true;
            ChapterService.createChapter(data, function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.addAnotherChapter();
                    }
                },
                function(response){
                    AlertService.error('form.form-horizontal', response.message);
                    $scope.laddaLoading = false;
                }
            );
        };

        $scope.goHome = function() {
            RouteService.home();
        };

        $scope.addAnotherChapter = function() {
            RouteService.reload();
        };
    });


