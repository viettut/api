'use strict';

angular
    .module('viettut')
    .factory('TutorialService', function($auth, $http, $q, config) {

        var createTutorial = function(data, successCallback, errorCallback) {
            $http.post(config.API_URL + 'tutorials', data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error) {
                    errorCallback(error);
                });
        };

        var addTag = function(tag, tutorialTags) {
            if (typeof tag.id == 'undefined') {
                tutorialTags.push({'tag': tag})
            }
            else {
                tutorialTags.push({'tag': tag.id})
            }

            return tutorialTags;
        };

        var removeTag = function(tag, tutorialTags) {
            var index = tutorialTags.indexOf(tag);
            return tutorialTags.splice(index, 1);
        };

        var filterTags = function($query, allTags) {
            var matches = [];
            for (var i = 0; i < allTags.length ; i++) {
                if (allTags[i].text.indexOf($query.toLowerCase()) >= 0 && $query.toLowerCase().length >= 3) {
                    matches.push(allTags[i]);
                }
            }

            return matches;
        };

        return {
            createTutorial: createTutorial,
            addTag: addTag,
            removeTag: removeTag,
            filterTags: filterTags
        };
    });