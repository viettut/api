/**
 * Created by giang on 21/05/2016.
 */
angular
    .module('viettut')
    .controller('TutorialController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, CourseService, AuthenService,  config) {
        $scope.content = $('textarea#content').val();
        $scope.isAuthenticated = $auth.isAuthenticated();
    });


