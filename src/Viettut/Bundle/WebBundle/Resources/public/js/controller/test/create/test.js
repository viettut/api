angular
    .module('viettut')
    .controller('TestController', function ($http, $scope, $window, Upload, $timeout, config) {
        $scope.laddaLoading = false;
        $scope.name = '';
        $scope.type = null;
        $scope.language = null;
        $scope.description = '';
        $scope.initialCode = '';
        $scope.expectedResult = {};
        $scope.options = [];
        $scope.option = '';
        $scope.optionError = false;
        $scope.files = [];
        $scope.inputData = {};
        $scope.serverParameters = {};
        $scope.uploaded = false;
        $scope.uploadError = false;
        $scope.choices = [{'value': ''}];

        $scope.addOption = function() {
            if (!$scope.option) {
                $scope.addError('An option can not be empty');
                return;
            }

            $scope.options.push($scope.option)
            $scope.option = '';
        };

        $scope.addNewChoice = function() {
            $scope.choices.push({'value': ''});
            console.log($scope.choices);
        };

        $scope.removeChoice = function() {
            var lastItem = $scope.choices.length-1;
            $scope.choices.splice(lastItem);
        };
    });


