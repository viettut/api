'use strict';

angular
    .module('viettut')
    .factory('UploadService', function($http, $q, $timeout, config, Upload) {
        var uploadImageForCourse = function(file, successCallback, errorCallback) {
            if (file && !file.$error) {
                file.upload = Upload.upload({
                    url: config.API_URL + 'courses/uploads',
                    file: file
                });

                file.upload.then(function (response) {
                    $timeout(function () {
                        successCallback(response);
                    });
                }, function (error) {
                    errorCallback(error);
                });
            }
            else {
                $scope.uploadError = true;
                $scope.uploadErrorMsg = 'Image\'s max height is 1000px and max size is 1MB';
            }
        };

        return {
            uploadImageForCourse: uploadImageForCourse
        };
    });
