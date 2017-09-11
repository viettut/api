/**
 * Created by giang on 22/05/2016.
 */
angular
    .module('viettut')
    .controller('ChapterController', function ($scope, RouteService, ChapterService, AlertService) {
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.header = '';
        $scope.chapter = {};
        $scope.content = '';
        $scope.loading = true;

        $scope.create = function () {
            var data = {
                header: $scope.header,
                content: $scope.content
            };

            // start progress
            $scope.laddaLoading = true;
            ChapterService.updateChapter($scope.chapterId, data, function(response) {
                $scope.laddaLoading = false;
                if(response.status == 204) {
                    $scope.chapter = response.data;
                    AlertService('form.form-horizontal', 'The chapter has been updated successfully!');
                }
            }, function (response) {
                if(response.status == 401) {
                    RouteService.login();
                }

                $scope.laddaLoading = false;
                $scope.error = response.data;
                $scope.showError = true;
            });
        };

        $scope.loadChapter = function() {
            ChapterService.getChapter($scope.chapterId, function(response){
                    $scope.loading = false;
                    if(response.status == 200) {
                        $scope.chapter = response.data;
                        $scope.header = $scope.chapter.header;
                        $scope.content = $scope.chapter.content;
                        $scope.loading = false;
                    }
                },
                function(response){
                    $scope.loading = false;
                    if(response.status == 401) {
                        RouteService.login();
                    }
                }
            );
        };

        $scope.$watch('chapterId', function(newVal, oldVal){
            $scope.chapterId = newVal;
            $scope.loadChapter();
        });
    });


