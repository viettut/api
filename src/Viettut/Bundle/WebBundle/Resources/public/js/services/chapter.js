'use strict';

angular
    .module('viettut')
    .factory('ChapterService', function($auth, $http, $q, config) {
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
            }
        };
    });