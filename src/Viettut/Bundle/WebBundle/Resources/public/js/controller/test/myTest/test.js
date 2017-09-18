angular
    .module('viettut')
    .controller('TestController', function ($scope, config, TestService, AlertService, RouteService) {
        $scope.myTests = [];
        $scope.loading = true;
        $scope.deletingTest = null;

        $scope.getFirstParagraph = function(str) {
            return str.substring(0, str.indexOf("\n"));
        };

        $scope.buildViewLink = function(test) {
            return config.BASE_URL + test.author.username + '/tests/' + test.hashTag;
        };

        $scope.edit = function(testIndex) {
            RouteService.editTest($scope.myTests[testIndex].token);
        };

        $scope.delete = function() {
            $scope.hideConfirm();

            if ($scope.deletingTest == null) {
                return;
            }

            TestService.deleteTest($scope.myTests[$scope.deletingTest].id, function(response) {
                $scope.loading = false;
                if(response.status == 204) {
                    AlertService.info('div.blog-posts', 'The test has been deleted successfully!');
                    $scope.myTests.splice($scope.deletingTest, 1);
                }
            }, function(response){
                $scope.loading = false;
                AlertService.error('div.blog-posts', response.message);
            });
        };

        $scope.showConfirm = function(courseIndex) {
            $scope.deletingTest = courseIndex;
            $('#deleteConfirm').modal('show');
        };

        $scope.hideConfirm = function() {
            $('#deleteConfirm').modal('hide');
        };

        TestService.getAllTests(function(response){
                $scope.loading = false;
                if (response.status == 200) {
                    $scope.myTests = response.data;
                }
            },
            function(response){
                $scope.loading = false;
                AlertService.error('div.blog-posts', response.message);
            })
    });


