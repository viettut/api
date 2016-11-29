angular
    .module('viettut')
    .controller('CourseController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, CourseService, AuthenService,  config) {
        $scope.introduce = $('textarea#introduce').val();
        $scope.isAuthenticated = $auth.isAuthenticated();
    });


