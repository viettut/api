/**
 * Created by giang on 22/05/2016.
 */
angular
    .module('viettut')
    .controller('ChapterController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, TagService, AuthenService,  config) {
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.header = '';
        $scope.chapter = {};
        $scope.content = '';
        $scope.loading = true;

        $scope.create = function () {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            var data = {
                header: $scope.header,
                content: $scope.content,
            };

            // start progress
            $scope.laddaLoading = true;

            $http.patch(config.API_URL + 'chapters/' + $scope.chapterId, data).
            then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 204) {
                        $scope.chapter = response.data;
                        $scope.alertSuccess();
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.alertSuccess = function() {
            var html = '<div class="alert alert-success">' +
                '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                '    Cập nhật thành công !' +
                '</div>';
            angular.element($('form.form-horizontal')).before(html);
        };

        $scope.loadChapter = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $http.get(config.API_URL + 'chapters/' + $scope.chapterId).
            then(
                function(response){
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
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }
                });
        };

        $scope.$watch('chapterId', function(newVal, oldVal){
            $scope.chapterId = newVal;
            $scope.loadChapter();
        });

        $scope.isAuthenticated = $auth.isAuthenticated();
    });


