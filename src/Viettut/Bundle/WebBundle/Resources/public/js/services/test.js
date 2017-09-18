'use strict';

angular
    .module('viettut')
    .factory('TestService', function($auth, $http, $q, config) {

        var getAllTests = function(successCallback, errorCallback) {
            $http.get(config.API_URL + 'tests').
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

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
            $http.post(config.API_URL + 'tests', data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

        var createTestCollection = function(data, successCallback, errorCallback) {
            $http.post(config.API_URL + 'testcollections', data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

        var getTestForChallenge = function(challengeId, successCallback, errorCallback) {
            $http.get(config.API_URL + 'challenges/' + challengeId  + '/tests').
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

        var getUnusedTestsForChallenge  = function(challengeId, successCallback, errorCallback) {
            $http.get(config.API_URL + 'challenges/' + challengeId  + '/unusedtests').
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

        var deleteTest = function(testId, successCallback, errorCallback) {
            $http.delete(config.API_URL + 'tests/' + challengeId).
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
            createTestCollection: createTestCollection,
            getTest: getTest,
            getAllTests: getAllTests,
            updateTest: updateTest,
            getTestForChallenge: getTestForChallenge,
            getUnusedTestsForChallenge: getUnusedTestsForChallenge,
            deleteTest: deleteTest
        };
    });