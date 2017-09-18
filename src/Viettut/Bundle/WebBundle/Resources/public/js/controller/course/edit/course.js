angular
    .module('viettut')
    .controller('CourseController', function ($scope, $state, RouteService, TagService, CourseService, AlertService, UploadService) {
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
        $scope.loading = true;

        $scope.course = {};

        //initialize
        TagService.getAllTags(function(response) {
            $scope.allTags = response.data;
        }, function(error){});

        $scope.addTag = function(tag) {
            $scope.courseTags = CourseService.addTag(tag, $scope.courseTags);
        };

        $scope.removeTag = function(tag) {
            $scope.courseTags = CourseService.removeTag(tag, $scope.courseTags);
        };

        $scope.filterTags = function($query) {
            return CourseService.filterTags($query, $scope.allTags);
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
            CourseService.updateCourse($scope.courseId, data, function(response) {
                $scope.laddaLoading = false;
                if(response.status == 204) {
                    $scope.course = response.data;
                    AlertService.info('form.form-horizontal', 'The course has been updated successfully!');
                }
            }, function (response) {
                $scope.laddaLoading = false;
                AlertService.error('form.form-horizontal', response.data.message);
            });
        };

        $scope.loadCourse = function() {
            CourseService.getCourse($scope.courseId, function(response) {
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
                }
            }, function(response) {
                $scope.loading = false;
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
                }, function (response) {
                    if (response.status > 0) {
                        $scope.uploadError = true;
                        AlertService.error('form.form-horizontal', response.status + ': ' + response.data);
                    }
                });
            }
            else {
                AlertService.error('form.form-horizontal', 'Image\'s max height is 1000px and max size is 1MB');
            }
        };

        $scope.$watch('courseId', function(newVal, oldVal){
            $scope.courseId = newVal;
            $scope.loadCourse();
        });


        $scope.addChapter = function() {
            var courseToken = $('input#course-token').val();
            RouteService.addChapter(courseToken);
        };
    });


