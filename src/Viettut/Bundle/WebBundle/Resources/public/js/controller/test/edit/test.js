angular
    .module('viettut')
    .controller('TestController', function ($http, $scope, TestService, AlertService, UploadService) {
        $scope.laddaLoading = false;
        $scope.name = '';
        $scope.type = null;
        $scope.language = null;
        $scope.description = '';
        $scope.initialCode = '';
        $scope.expectedResult = {};
        $scope.options = [];
        $scope.option = '';
        $scope.files = [];
        $scope.inputData = {};
        $scope.serverParameters = {};
        $scope.uploaded = false;
        $scope.uploadError = false;
        $scope.test = {};
        $scope.choices = [{'value': '', 'correct': '0'}];
        $scope.testId = -1;
        $scope.loading = true;

        $scope.addNewChoice = function() {
            $scope.choices.push({'value': ''});
            console.log($scope.choices);
        };

        $scope.removeChoice = function() {
            var lastItem = $scope.choices.length-1;
            $scope.choices.splice(lastItem);
        };

        $scope.clear = function() {
            $scope.name = '';
            $scope.type = 1;
            $scope.language = null;
            $scope.description = '';
            $scope.initialCode = '';
            $scope.inputData = {};
            $scope.serverParameters = {};
            $scope.choices = [{'value': '', 'correct': '0'}];
            $scope.laddaLoading = false;
        };

        $scope.create = function() {
            var data = {
                name: $scope.name,
                type: $scope.type,
                language: $scope.language,
                description: $scope.description,
                initialCode: $scope.initialCode,
                inputData: $scope.inputData,
                serverParameters: $scope.serverParameters,
                testCollection: []
            };

            $scope.laddaLoading = true;
            TestService.updateTest($scope.testId, data,
                function(response) {
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.test = response.data;
                        AlertService.info('form.form-horizontal', 'The test has been created successfully');
                        $scope.clear();
                    }
                },
                function (response) {
                    $scope.laddaLoading = false;
                    AlertService.error('form.form-horizontal', response.data.message);
                }
            );
        };

        $scope.uploadFiles = function (file) {
            $scope.f = file;
            if (file && !file.$error) {
                UploadService.uploadFileForChallenge(file, function(response) {
                    $scope.image = response.data;
                    $scope.uploaded = true;
                    $scope.uploadError = false;
                }, function (response) {
                    if (response.status > 0) {
                        $scope.uploadError = true;
                        $scope.uploadErrorMsg = response.status + ': ' + response.data;
                    }
                });
            }
            else {
                $scope.uploadError = true;
                $scope.uploadErrorMsg = 'Image\'s max height is 1000px and max size is 1MB';
            }
        };

        $scope.$watch('testId', function(newVal, oldVal){
            $scope.testId = newVal;
            TestService.getTest($scope.testId,
                function(response) {
                    $scope.loading = false;
                    $scope.name = response.data.name;
                    $scope.type = response.data.type;
                    $scope.language = response.data.language;
                    $scope.description = response.data.description;
                    $scope.initialCode = response.data.initialCode;
                    $scope.inputData = response.data.inputData;
                    $scope.serverParameters = response.data.serverParameters;
                },
                function(response) {}
            )
        });
    });


