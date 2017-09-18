angular
    .module('viettut')
    .controller('ChallengeController', function ($scope, config, ChallengeService, AlertService, RouteService) {
        $scope.myChallenges = [];
        $scope.loading = true;
        $scope.deletingTest = null;

        $scope.buildViewLink = function(challenge) {
            return config.BASE_URL + challenge.author.username + '/challenges/' + challenge.hashTag;
        };

        $scope.edit = function(challengeIndex) {
            RouteService.editChallenge($scope.myChallenges[challengeIndex].token);
        };

        $scope.delete = function() {
            $scope.hideConfirm();

            if ($scope.deletingTest == null) {
                return;
            }

            ChallengeService.deleteChallenge($scope.myChallenges[$scope.deletingTest].id, function(response) {
                $scope.loading = false;
                if(response.status == 204) {
                    AlertService.info('div.blog-posts', 'The challenge has been deleted successfully!');
                    $scope.myChallenges.splice($scope.deletingTest, 1);
                }
            }, function(response){
                $scope.loading = false;
                AlertService.error('div.blog-posts', response.message);
            });
        };

        $scope.showConfirm = function(challengeIndex) {
            $scope.deletingTest = challengeIndex;
            $('#deleteConfirm').modal('show');
        };

        $scope.hideConfirm = function() {
            $('#deleteConfirm').modal('hide');
        };

        ChallengeService.getChallenge(
            function(response){
                $scope.loading = false;
                if (response.status == 200) {
                    $scope.myChallenges = response.data;
                }
            },
            function(response){
                $scope.loading = false;
                AlertService.error('div.blog-posts', response.message);
            }
        )
    });


