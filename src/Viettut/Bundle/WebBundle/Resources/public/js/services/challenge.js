'use strict';

angular
    .module('viettut')
    .factory('ChallengeService', function($auth, $http, $q, config) {
        var getChallenge = function(id, successCallback, errorCallback) {
            $http.get(config.API_URL + 'challenges/' + id).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

        var updateChallenge = function(id, data, successCallback, errorCallback) {
            $http.patch(config.API_URL + 'challenges/' + id, data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error)
                }
            );
        };

        var createChallenge = function(data, successCallback, errorCallback) {
            $http.post(config.API_URL + 'challenges', data).
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
            createChallenge: createChallenge,
            getChallenge: getChallenge,
            updateChallenge: updateChallenge
        };
    });