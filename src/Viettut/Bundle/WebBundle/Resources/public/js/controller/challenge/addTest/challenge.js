angular
    .module('viettut')
    .controller('ChallengeController', function ($http, $scope, TestService, AlertService, UploadService) {
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
        $scope.challengeId = -1;
        $scope.allTests = [];
        $scope.tests = [];
        $scope.selectTest = false;

        $scope.$watch('challengeId', function(newVal, oldVal){
            $scope.challengeId = newVal;
            TestService.getUnusedTestsForChallenge(
                $scope.challengeId,
                function(response) {
                    $scope.allTests = response.data;
                },
                function(response){}
            );
        });

        $scope.addNewChoice = function() {
            $scope.choices.push({'value': ''});
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
            var test = {
                name: $scope.name,
                type: $scope.type,
                language: $scope.language,
                description: $scope.description,
                initialCode: $scope.initialCode,
                inputData: $scope.inputData,
                serverParameters: $scope.serverParameters,
                files: $scope.files
            };

            if (selectTest) {
                test = $scope.tests[0];
            }

            var $tesCollection = {
                test: test,
                challenge: $scope.challengeId
            };

            $scope.laddaLoading = true;
            TestService.createTestCollection($tesCollection,
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
    });


