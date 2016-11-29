'use strict';

angular
    .module('viettut')
    .factory('TagService', function($auth, $http, $q, config) {
        return {
            getAllTags: function() {
                var deferred = $q.defer();

                $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
                $http({
                    method: 'GET',
                    url: config.API_URL + 'tags'
                }).success(function (data) {
                    deferred.resolve(data);
                }).error(function (msg) {
                    deferred.reject(msg);
                });

                return deferred.promise;
            }
        };
    });