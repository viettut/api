angular
    .module('viettut')
    .controller('ChallengeController', function ($scope, RouteService, AlertService, ChallengeService) {
        $scope.laddaLoading = false;
        $scope.name = '';
        $scope.timeLimit = -1;
        $scope.published = false;
        $scope.loading = true;
        $scope.challengeId = -1;

        $scope.create = function () {
            var data = {
                name: $scope.name,
                published: $scope.published,
                timeLimit: $scope.timeLimit,
                testCollection: []
            };

            // start progress
            $scope.laddaLoading = true;
            ChallengeService.updateChallenge($scope.challengeId, data,
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

        $scope.$watch('challengeId', function(newVal, oldVal){
            $scope.challengeId = newVal;
            ChallengeService.getChallenge($scope.challengeId,
                function(response) {
                    $scope.loading = false;
                    $scope.name = response.data.name;
                    $scope.published = response.data.published;
                    $scope.timeLimit = response.data.timeLimit;
                },
                function(response) {}
            )
        });
    });


