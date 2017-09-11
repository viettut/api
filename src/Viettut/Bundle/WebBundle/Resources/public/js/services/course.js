'use strict';

angular
    .module('viettut')
    .factory('CourseService', function($auth, $http, $q, config) {

        var createCourse = function(data, successCallback, errorCallback) {
            $http.post(config.API_URL + 'courses', data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error) {
                    errorCallback(error);
                });
        };

        var updateCourse = function(id, data, successCallback, errorCallback) {
            $http.patch(config.API_URL + 'courses/' + id, data).
            then(
                function(response){
                    successCallback(response);
                },
                function(error){
                    errorCallback(error);
                });
        };

        var getCourse = function(id, successCallback, errorCallback) {
            $http.get(config.API_URL + 'courses/' + id).
            then(
                function(response){
                    successCallback(response);
                },
                function(response){
                    errorCallback(response);
                });
        };

        var deleteCourse = function(id, successCallback, errorCallback) {
            $http.delete(config.API_URL + 'courses/' + id).
            then(
                function(response){
                    successCallback(response);
                },
                function(response){
                    errorCallback(response);
                });
        };

        var getAllCourses = function(successCallback, errorCallback) {
            $http.get(config.API_URL + 'courses')
                .then(function(response) {
                    successCallback(response);
                }, function(error) {
                    errorCallback(error);
                });
        };

        var getMyCourses = function(successCallback, errorCallback) {
            $http.get(config.API_URL + 'mycourses')
                .then(function(response) {
                    successCallback(response);
                }, function(error) {
                    errorCallback(error);
                });
        };

        var addTag = function(tag, courseTags) {
            if (typeof tag.id == 'undefined') {
                courseTags.push({'tag': tag})
            }
            else {
                courseTags.push({'tag': tag.id})
            }

            return courseTags;
        };

        var removeTag = function(tag, courseTags) {
            var index = courseTags.indexOf(tag);
            return courseTags.splice(index, 1);
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
            getAllCourses: getAllCourses,
            getMyCourses : getMyCourses,
            getCourse: getCourse,
            deleteCourse: deleteCourse,
            createCourse: createCourse,
            updateCourse: updateCourse,
            addTag: addTag,
            removeTag: removeTag,
            filterTags: filterTags
        };
    });