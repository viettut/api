angular
    .module('viettut')
    .controller('ChapterController', function ($scope) {
        $scope.content = $('textarea#content').val();
    });


