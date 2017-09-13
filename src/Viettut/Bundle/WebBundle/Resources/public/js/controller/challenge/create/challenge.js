angular
    .module('viettut')
    .controller('CourseController', function ($scope, RouteService, TestService, AlertService, UploadService, ChallengeService) {
        $scope.laddaLoading = false;
        $scope.name = '';
        $scope.timeLimit = -1;
        $scope.published = false;

        //initialize
        TestService.getAllTests(
            function(response) {
                response.data.forEach(function(test) {
                    $scope.allTests.push({'id': test.id, 'name': test.name});
                });
            },
            function(error){}
        );

        $scope.create = function () {
            var data = {
                name: $scope.name,
                published: $scope.published,
                timeLimit: $scope.timeLimit
            };

            // start progress
            $scope.laddaLoading = true;
            ChallengeService.createChallenge(data, function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.course = response.data;
                        RouteService.myChallenge();
                    }
                },
                function(response) {
                    $scope.laddaLoading = false;
                    AlertService.error('form.form-horizontal', response.data.message);
                });
        };
    });


