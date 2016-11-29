'use strict';

angular
    .module('viettut')
    .factory('AuthenService', function($auth, $http, $q, $window, config) {
        return {
            getChaptersByCourse: function(cid) {
                var deferred = $q.defer();

                $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
                $http({
                    method: 'GET',
                    url: config.API_URL + 'courses/' + cid + '/chapters'
                }).success(function (data) {
                    deferred.resolve(data);
                }).error(function (msg) {
                    deferred.reject(msg);
                });

                return deferred.promise;
            },
            login: function() {
                $window.location.href = config.BASE_URL + 'login';
            },
            register: function() {
                $window.location.href = config.BASE_URL + 'register';
            },
            goHome: function(){
                $window.location.href = config.BASE_URL;
            }
        };
    });