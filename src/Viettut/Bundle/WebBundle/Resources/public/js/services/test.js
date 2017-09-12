'use strict';

angular
    .module('viettut')
    .factory('TestService', function($auth, $http, $q, config) {
        var getTest = function(id, successCallback, errorCallback) {
            $http.get(config.API_URL + 'tests/' + id).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

        var updateTest = function(id, data, successCallback, errorCallback) {
            $http.patch(config.API_URL + 'tests/' + id, data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error)
                }
            );
        };

        var createTest = function(data, successCallback, errorCallback) {
            $http.post(config.API_URL + 'chapters', data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

        return {
            createTest: createTest,
            getTest: getTest,
            updateTest: updateTest
        };
    });