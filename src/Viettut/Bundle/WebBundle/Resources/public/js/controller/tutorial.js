angular
    .module('viettut')
    .controller('TutorialController', function ($auth, $http, $scope, $window, config, AuthenService) {
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.tutorialTags = [];
        $scope.selectedTags = [];
        $scope.allTags = [];
        $scope.preview = '';
        $scope.previewText = 'Show Preview';
        $scope.showPreview = false;

        $scope.title = '';
        $scope.content = '';

        $scope.tutorial = {};

        $scope.initTag = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $scope.allTags = $http.get(config.BASE_URL + 'api/v1/tags');
        };
        //initialize
        $scope.initTag();

        $scope.preview = function(){
            $scope.showPreview = !$scope.showPreview;

            if($scope.showPreview) {
                $scope.previewText = 'Hide Preview';
            }
            else $scope.previewText = 'Show Preview';
        };

        $scope.loadTags = function() {
            return $scope.allTags;
        };

        $scope.addTag = function(tag) {
            if (typeof tag.id == 'undefined') {
                $scope.tutorialTags.push({'tag': tag})
            }
            else {
                $scope.tutorialTags.push({'tag': tag.id})
            }
        };

        $scope.create = function () {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            var data = {
                title: $scope.title,
                content: $scope.content,
                tutorialTags: $scope.tutorialTags
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post(config.BASE_URL + 'api/v1/tutorials', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.tutorial = response.data;
                        $window.location.href = config.BASE_URL + 'tutorials/all';
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.isAuthenticated = $auth.isAuthenticated();

    });

