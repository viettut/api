'use strict';

angular
    .module('viettut')
    .factory('ChapterService', function($auth, $http, $q, config) {
        var getChapter = function(id, successCallback, errorCallback) {
            $http.get(config.API_URL + 'chapters/' + id).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                }
            );
        };

        var updateChapter = function(id, data, successCallback, errorCallback) {
            $http.patch(config.API_URL + 'chapters/' + id, data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error)
                }
            );
        };
        
        var createChapter = function(data, successCallback, errorCallback) {
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
            createChapter: createChapter,
            getChapter: getChapter,
            updateChapter: updateChapter
        };
    });