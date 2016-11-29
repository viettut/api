/**
 * Created by giang on 8/23/15.
 */
(function(){
    'use strict';

    /**
     * @ngdoc function
     * @name viettut.controller:HomeCtrl
     * @description
     * # HomeCtrl
     * Controller of the viettut
     */
    angular
        .module('viettut')
        .controller('HomeController', HomeController);

    function HomeController($scope) {
        $scope.team = [
            {name: 'John Doe', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'ceo'},
            {name: 'Dolce galbana', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'marketing'},
            {name: 'Mark Zugkernburg', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'developer'},
            {name: 'Kevin Blackman', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'developer'},
            {name: 'Luica Malboro', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'marketing'},
            {name: 'Daniel Brown', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'developer'},
            {name: 'Susan Bones', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'marketing'},
            {name: 'Alicia Keys', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'marketing'},
            {name: 'Miley Crus', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'marketing'},
            {name: 'David Costa', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'developer'},
            {name: 'Lara Crush', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'designer'},
            {name: 'Lana Lang', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'designer'},
            {name: 'Clark Ken', image :'/bundles/viettutweb/img/team/team-1.jpg', position: 'designer'}
        ];
    };
})();

