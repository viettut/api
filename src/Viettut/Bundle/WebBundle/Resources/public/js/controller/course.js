/**
 * Created by giang on 8/23/15.
 */
(function() {
    'use strict';

    /**
     * @ngdoc function
     * @name viettut.controller:GuideController
     * @description
     * # GuideController
     * Controller of the viettut
     */
    angular
        .module('viettut')
        .controller('CourseController', GuideController);

    function GuideController($auth, $http, $scope, $window, Upload, $timeout, $state) {
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.title = '';
        $scope.courseTags = [];
        $scope.selectedTags = [];
        $scope.allTags = [];
        $scope.introduce = angular.element($('#introduce')).text() === 'undefined' ? '' : angular.element($('#introduce')).text();
        $scope.image = '';
        $scope.chapter = '';
        $scope.content = '';
        $scope.uploaded = false;
        $scope.uploadError = false;
        $scope.preview = '';
        $scope.titleValid = $scope.title.length < 15;
        $scope.introduceValid = $scope.introduce < 32;
        $scope.previewText = 'Show Preview';
        $scope.showPreview = false;

        $scope.course = {};

        $scope.initTag = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $scope.allTags = $http.get('/app_dev.php/api/v1/tags');
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
                $scope.courseTags.push({'tag': tag})
            }
            else {
                $scope.courseTags.push({'tag': tag.id})
            }
        };

        $scope.add = function(){
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            var data = {
                header: $scope.chapter,
                content: $scope.content,
                course: $scope.course.id
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post('/app_dev.php/api/v1/chapters', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $window.location.reload();
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        $window.location.href = '/web/app_dev.php/login';
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.upload = function () {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            var data = {
                title: $scope.title,
                imagePath: $scope.image,
                introduce: $scope.introduce,
                courseTags: $scope.courseTags
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post('/app_dev.php/api/v1/courses', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.course = response.data;
                        $state.go('add-chapter', {cid: response.data.id});
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        $window.location.href = '/web/app_dev.php/login';
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.isAuthenticated = $auth.isAuthenticated();

        $scope.uploadFiles = function (file) {
            $scope.f = file;
            if (file && !file.$error) {
                file.upload = Upload.upload({
                    url: '/app_dev.php/courses/upload',
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
    }
})();
