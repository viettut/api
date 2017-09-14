angular
    .module('viettut')
    .controller('ChallengeController', function ($scope, RouteService, AlertService, ChallengeService) {
        $scope.laddaLoading = false;
        $scope.name = '';
        $scope.timeLimit = -1;
        $scope.published = false;

        $scope.create = function () {
            var data = {
                name: $scope.name,
                published: $scope.published,
                timeLimit: $scope.timeLimit,
                testCollection: []
            };

            // start progress
            $scope.laddaLoading = true;
            ChallengeService.createChallenge(data,
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.course = response.data;
                        RouteService.myChallenge();
                    }
                },
                function(response) {
                    $scope.laddaLoading = false;
                    AlertService.error('form.form-horizontal', response.data.message);
                }
            );
        };
    });


