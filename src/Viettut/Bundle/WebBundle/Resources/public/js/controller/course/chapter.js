angular
    .module('viettut')
    .controller('ChapterController', function ( $http, $scope, $window, config) {
        $scope.previewText = 'Show Preview';
        $scope.showPreview = false;
        $scope.header = '';
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.courseId = angular.element($('#courseId')).text();
        $scope.introduce = $('textarea#introduce').val();

        $scope.getCourse = function() {
            $http({
                method: 'GET',
                url: config.API_URL + 'courses/' + $scope.courseId
            }).then(function successCallback(response) {
                $scope.course = response.data;
            }, function errorCallback(response) {
            });

            console.log($scope.course.id);
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

            $http.post(config.API_URL + 'chapters', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.addAnotherChapter();
                    }
                },
                function(response){
                    $scope.addError(response.message);
                    $scope.laddaLoading = false;
                });
        };

        $scope.goHome = function() {
            $window.location.href = config.BASE_URL;
        };

        $scope.addAnotherChapter = function(){
            $window.location.reload();
        };

        $scope.addError = function(message) {
            var html = '<div class="alert alert-danger alert-dismissable">' +
                '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                message +
                '</div>';
            angular.element($('form.form-horizontal')).before(html);
        };

        $scope.addInfo = function(message) {
            var html = '<div class="alert alert-success alert-dismissable">' +
                '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                message +
                '</div>';
            angular.element($('form.form-horizontal')).before(html);
        };
    });


