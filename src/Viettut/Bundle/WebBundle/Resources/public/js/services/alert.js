'use strict';

angular
    .module('viettut')
    .factory('AlertService', function() {
        var error = function(anchor, message) {
            var html = '<div class="alert alert-danger alert-dismissable">' +
                '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                message +
                '</div>';
            angular.element($(anchor)).before(html);
        };

        var info = function(anchor, message) {
            var html = '<div class="alert alert-success alert-dismissable">' +
                '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                message +
                '</div>';
            angular.element($(anchor)).before(html);
        };

        return {
            error: error,
            info: info
        };
    });
