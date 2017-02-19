angular
    .module('viettut')
    .controller('CourseController', function ($http, $scope, $window, Upload, $timeout, $state, config) {
        $scope.laddaLoading = false;
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
        $scope.loading = true;

        $scope.course = {};

        $scope.initTag = function() {
            $http.get(config.API_URL + 'tags')
            .then(function(response) {
                $scope.allTags = response.data;
            });
        };
        //initialize
        $scope.initTag();

        $scope.filterTags = function($query) {
            var matches = [];
            for (var i = 0; i < $scope.allTags.length ; i++) {
                if ($scope.allTags[i].text.indexOf($query.toLowerCase()) >= 0 && $query.toLowerCase().length >= 3) {
                    matches.push($scope.allTags[i]);
                }
            }

            return matches;
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
                        $scope.addInfo('The course has been updated successfully!');
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

        $scope.loadCourse = function() {
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
                    $scope.laddaLoading = false;
                    $scope.addError(response.data.message);
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
    });


