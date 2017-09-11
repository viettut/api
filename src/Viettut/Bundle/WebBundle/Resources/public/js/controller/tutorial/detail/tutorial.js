/**
 * Created by giang on 21/05/2016.
 */
angular
    .module('viettut')
    .controller('TutorialController', function ($auth, $http, $scope) {
        $scope.content = $('textarea#content').val();
    });


