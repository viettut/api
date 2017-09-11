'use strict';

angular
    .module('viettut')
    .factory('TagService', function($auth, $http, $q, config) {
        var getAllTags = function(successCallback, errorCallback) {
            $http.get(config.API_URL + 'tags')
                .then(function(response) {
                    successCallback(response);
                }, function(error) {
                    errorCallback(error);
                });
        };

        return {
            getAllTags: getAllTags
        };
    });