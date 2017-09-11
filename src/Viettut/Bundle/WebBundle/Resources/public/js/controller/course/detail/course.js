angular
    .module('viettut')
    .controller('CourseController', function ($auth, $http, $scope) {
        $scope.introduce = $('textarea#introduce').val();
        $scope.isAuthenticated = $auth.isAuthenticated();
    });


