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

        $scope.addOption = function() {
            if (!$scope.option) {
                $scope.addError('An option can not be empty');
                return;
            }

            $scope.options.push($scope.option)
            $scope.option = '';
        };

        $scope.removeTag = function(tag) {
            var index = $scope.courseTags.indexOf(tag);
            $scope.courseTags.splice(index, 1);
        };

        $scope.create = function () {
            var data = {
                title: $scope.title,
                imagePath: $scope.image,
                introduce: $scope.introduce,
                courseTags: $scope.courseTags,
                published: $scope.published
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post(config.API_URL + 'courses', data).
            then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.course = response.data;
                        $window.location.href = config.BASE_URL + 'courses/' + $scope.course.token + '/add-chapter';
                    }
                },
                function(response) {
                    $scope.laddaLoading = false;
                    $scope.addError(response.data.message);
                });
        };


        $scope.uploadFiles = function (file) {
            $scope.f = file;
            if (file && !file.$error) {
                file.upload = Upload.upload({
                    url: config.API_URL + 'courses/uploads?XDEBUG_SESSION_START=1',
                    file: file
                });

                file.upload.then(function (response) {
                    $timeout(function () {
                        file.result = response.data;
                        $scope.image = response.data;
                        $scope.uploaded = true;
                        $scope.uploadError = false;
                    });
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


