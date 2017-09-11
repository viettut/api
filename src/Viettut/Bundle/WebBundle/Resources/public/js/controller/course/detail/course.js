angular
    .module('viettut')
    .controller('CourseController', function ($auth, $scope) {
        $scope.introduce = $('textarea#introduce').val();
        $scope.isAuthenticated = $auth.isAuthenticated();
    });


