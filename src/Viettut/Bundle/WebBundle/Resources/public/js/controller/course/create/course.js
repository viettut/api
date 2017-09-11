angular
    .module('viettut')
    .controller('CourseController', function ($scope, $window, TagService, AlertService, UploadService, CourseService) {
        $scope.laddaLoading = false;
        $scope.title = '';
        $scope.courseTags = [];
        $scope.selectedTags = [];
        $scope.allTags = [];
        $scope.image = '';
        $scope.chapter = '';
        $scope.content = '';
        $scope.uploaded = false;
        $scope.uploadError = false;
        $scope.published = false;
        $scope.course = {};

        //initialize
        TagService.getAllTags(function(response) {
            $scope.allTags = response.data;
        }, function(error){});

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
            CourseService.createCourse(data, function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.course = response.data;
                        $window.location.href = config.BASE_URL + 'courses/' + $scope.course.token + '/add-chapter';
                    }
                },
                function(response) {
                    $scope.laddaLoading = false;
                    AlertService.error('form.form-horizontal', response.data.message);
                });
        };

        $scope.uploadFiles = function (file) {
            $scope.f = file;
            if (file && !file.$error) {
                UploadService.uploadImageForCourse(file, function(response) {
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

        $scope.addTag = function(tag) {
            $scope.courseTags = CourseService.addTag(tag, $scope.courseTags);
        };

        $scope.removeTag = function(tag) {
            $scope.courseTags = CourseService.removeTag(tag, $scope.courseTags);
        };

        $scope.filterTags = function($query) {
            return CourseService.filterTags($query, $scope.allTags);
        };
    });


