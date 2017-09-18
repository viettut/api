'use strict';

angular
    .module('viettut')
    .factory('RouteService', function($window, config) {
        var addChapter = function(token) {
            $window.location.href = config.BASE_URL + 'courses/' + token + '/add-chapter';
        };
        
        var editCourse = function (token) {
            $window.location.href = config.BASE_URL + 'courses/' + token + '/edit';
        };

        var editTest = function (token) {
            $window.location.href = config.BASE_URL + 'tests/' + token + '/edit';
        };

        var editChallenge = function (token) {
            $window.location.href = config.BASE_URL + 'challenges/' + token + '/edit';
        };
        
        var tutorialIndex = function () {
            $window.location.href = config.BASE_URL + 'tutorials/all';
        };

        var home = function() {
            $window.location.href = config.BASE_URL;  
        };
        
        var login = function () {
            $window.location.href = config.BASE_URL + 'login';  
        };
        
        var reload = function() {
            $window.location.reload();
        };

        var myChallenge = function() {
            $window.location.href = config.BASE_URL + 'mychallenges';
        };
        
        return {
            home: home,
            editTest: editTest,
            login: login,
            reload: reload,
            addChapter: addChapter,
            editCourse: editCourse,
            tutorialIndex: tutorialIndex,
            myChallenge: myChallenge,
            editChallenge: editChallenge
        };
    });