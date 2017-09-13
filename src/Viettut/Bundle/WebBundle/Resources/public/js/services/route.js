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
            login: login,
            reload: reload,
            addChapter: addChapter,
            editCourse: editCourse,
            tutorialIndex: tutorialIndex,
            myChallenge: myChallenge
        };
    });