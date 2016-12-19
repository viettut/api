angular
    .module('viettut')
    .controller('CourseController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, TagService, AuthenService, config) {
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.title = '';
        $scope.courseTags = [];
        $scope.selectedTags = [];
        $scope.allTags = [];
        $scope.image = '';
        $scope.chapter = '';
        $scope.content = '';
        $scope.uploaded = false;
        $scope.uploadError = false;
        $scope.preview = '';
        $scope.titleValid = $scope.title.length < 15;
        $scope.introduceValid = $scope.introduce < 32;

        $scope.course = {};

        $scope.initTag = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $scope.allTags = TagService.getAllTags();
        };
        //initialize
        $scope.initTag();

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

        $scope.removeTag = function(tag) {
            var index = $scope.courseTags.indexOf(tag);
            $scope.courseTags.splice(index, 1);
        };

        $scope.create = function () {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            var data = {
                title: $scope.title,
                imagePath: $scope.image,
                introduce: $scope.introduce,
                courseTags: $scope.courseTags
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

        $scope.uploadFiles = function (file) {
            $scope.f = file;
            if (file && !file.$error) {
                file.upload = Upload.upload({
                    url: config.BASE_URL + 'courses/upload',
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
    });


