angular
    .module('viettut')
    .controller('CourseController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, TagService, AuthenService,  config) {
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
        $scope.published = false;
        $scope.uploaded = false;
        $scope.uploadError = false;
        $scope.preview = '';
        $scope.titleValid = $scope.title.length < 15;
        $scope.introduceValid = $scope.introduce < 32;
        $scope.loading = true;

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
                courseTags: $scope.courseTags,
                published: $scope.published
            };

            // start progress
            $scope.laddaLoading = true;

            $http.patch(config.API_URL + 'courses/' + $scope.courseId, data).
            then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 204) {
                        $scope.course = response.data;
                        $scope.alertSuccess();
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

        $scope.alertSuccess = function() {
            var html = '<div class="alert alert-success">' +
                       '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                       '    <strong>Good job!</strong> The course has been created successfully !' +
                       '</div>';
            angular.element($('form.form-horizontal')).before(html);
        };

        $scope.loadCourse = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $http.get(config.API_URL + 'courses/' + $scope.courseId).
            then(
                function(response){
                    $scope.loading = false;
                    if(response.status == 200) {
                        $scope.course = response.data;
                        $scope.introduce = $scope.course.introduce;
                        $scope.title = $scope.course.title;
                        $scope.image = $scope.course.imagePath;
                        $scope.published = $scope.course.published;

                        var tagsLength = $scope.course.courseTags.length;
                        for(var i = 0; i < tagsLength; i++) {
                            $scope.courseTags.push({'tag': $scope.course.courseTags[i].tag.id});
                            $scope.selectedTags.push({'text': $scope.course.courseTags[i].tag.text});
                        }

                        $scope.loading = false;
                    }
                },
                function(response){
                    $scope.loading = false;
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }
                });
        };

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

        $scope.$watch('courseId', function(newVal, oldVal){
            $scope.courseId = newVal;
            $scope.loadCourse();
        });


        $scope.addChapter = function() {
            var courseToken = $('input#course-token').val();
            $window.location.href = config.BASE_URL + 'courses/' + courseToken + '/add-chapter';
        };

        $scope.isAuthenticated = $auth.isAuthenticated();
    });


