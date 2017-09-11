'use strict';

angular
    .module('viettut')
    .factory('CommentService', function($http, $q, config) {
        var getCommentForChapter = function(id, successCallback, errorCallback) {
            $http({
                method: 'GET',
                url: config.API_URL + 'chapters/' + id + '/comments'
            }).then(function (response) {
                successCallback(response);
            }, function (error) {
                errorCallback(error);
            });
        };

        var getCommentForTutorial = function(id, successCallback, errorCallback) {
            $http({
                method: 'GET',
                url: config.API_URL + 'tutorials/' + id + '/comments'
            }).then(function (response) {
                successCallback(response);
            }, function (error) {
                errorCallback(error);
            });
        };

        var createComment = function(data, successCallback, errorCallback) {
            $http.post(config.API_URL + 'comments', data).
            then(
                function(response){
                    successCallback(response);
                },
                function(response){
                    errorCallback(response);
                }
            );
        };

        return {
            getCommentForChapter: getCommentForChapter,
            getCommentForTutorial: getCommentForTutorial,
            createComment: createComment
        };
    });
