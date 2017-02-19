angular
    .module('viettut')
    .controller('TutorialController', function ($http, $scope, $window, config) {
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.tutorialTags = [];
        $scope.selectedTags = [];
        $scope.allTags = [];
        $scope.title = '';
        $scope.content = '';
        $scope.tutorial = {};

        $scope.initTag = function() {
            $http.get(config.API_URL + 'tags')
            .then(function(response) {
                $scope.allTags = response.data;
            });
        };

        $scope.filterTags = function($query) {
            var matches = [];
            for (var i = 0; i < $scope.allTags.length ; i++) {
                if ($scope.allTags[i].text.indexOf($query.toLowerCase()) >= 0 && $query.toLowerCase().length >= 3) {
                    matches.push($scope.allTags[i]);
                }
            }

            return matches;
        };
        
        //initialize
        $scope.initTag();

        $scope.addTag = function(tag) {
            if (typeof tag.id == 'undefined') {
                $scope.tutorialTags.push({'tag': tag})
            }
            else {
                $scope.tutorialTags.push({'tag': tag.id})
            }
        };

        $scope.create = function () {
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
                    $scope.laddaLoading = false;
                    $scope.addError(response.data.message);
                });
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

