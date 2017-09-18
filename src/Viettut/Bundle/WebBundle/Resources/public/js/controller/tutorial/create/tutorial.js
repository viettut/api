angular
    .module('viettut')
    .controller('TutorialController', function ($scope, TagService, TutorialService, AlertService, RouteService) {
        $scope.laddaLoading = false;
        $scope.tutorialTags = [];
        $scope.selectedTags = [];
        $scope.allTags = [];
        $scope.title = '';
        $scope.video = '';
        $scope.content = '';
        $scope.tutorial = {};

        //initialize
        TagService.getAllTags(
            function(response) {
                $scope.allTags = response.data;
            },
            function(error){
                AlertService.error('form.form-horizontal', error.data.message);
            }
        );

        $scope.addTag = function(tag) {
            $scope.tutorialTags = TutorialService.addTag(tag, $scope.tutorialTags);
        };

        $scope.removeTag = function(tag) {
            $scope.tutorialTags = TutorialService.removeTag(tag, $scope.tutorialTags);
        };

        $scope.filterTags = function($query) {
            return TutorialService.filterTags($query, $scope.allTags);
        };

        $scope.create = function () {
            var data = {
                title: $scope.title,
                video: $scope.video,
                content: $scope.content,
                tutorialTags: $scope.tutorialTags
            };

            // start progress
            $scope.laddaLoading = true;
            TutorialService.createTutorial(data,  
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.tutorial = response.data;
                        RouteService.tutorialIndex();
                    }
                },
                function(response){
                    $scope.laddaLoading = false;
                    AlertService.error('form.form-horizontal', response.data.message);
                }
            );
        };
    });