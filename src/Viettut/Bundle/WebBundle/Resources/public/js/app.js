(function() {
    'use strict';

    /**
     * @ngdoc overview
     * @name viettut
     * @description
     * # viettut
     *
     * Main module of the application.
     */
    angular
        .module('viettut', ['hc.marked', 'hljs', 'angular-markdown-editor', 'ui.router', 'ngTagsInput', 'ngSanitize', 'ngFileUpload', 'ladda', 'ngStorage', 'satellizer', 'ngAnimate', 'ui.bootstrap'])
        .constant('config', {
            'API_URL' : '/api/v1/',
            'PUBLIC_API_URL' : '/public/api/',
            'BASE_URL' : '/',
            'SIGN_UP_URL' : '/api/user/v1/users',
            'SIGN_UP_REDIRECT' : 'login'
        })
        // .constant('config', {
        //    'API_URL' : '/app_dev.php/api/v1/',
        //    'PUBLIC_API_URL' : '/app_dev.php/public/api/',
        //    'BASE_URL' : '/app_dev.php/',
        //    'SIGN_UP_URL' : '/app_dev.php/api/user/v1/users',
        //    'SIGN_UP_REDIRECT' : 'login'
        // })
        .config(function ($authProvider, $interpolateProvider, config) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $authProvider.loginUrl = config.API_URL + 'getToken';
            $authProvider.signupUrl = config.BASE_URL + 'api/user/v1/users';
            $authProvider.signupRedirect = config.BASE_URL + 'login';

            // Social login
            $authProvider.facebook({
                name: 'facebook',
                clientId: '1245562308819573',
                url: '/facebook/login',
                authorizationEndpoint: 'https://www.facebook.com/v2.5/dialog/oauth',
                redirectUri: window.location.origin + '/',
                requiredUrlParams: ['display', 'scope'],
                scope: ['email'],
                scopeDelimiter: ',',
                display: 'popup',
                type: '2.0',
                popupOptions: { width: 580, height: 400 }
            });

            $authProvider.google({
                clientId: '355171488116-rml9h7b9ivdn8ub5sgu6r6eh1vkluvav.apps.googleusercontent.com',
                url: '/google/login',
                authorizationEndpoint: 'https://accounts.google.com/o/oauth2/auth',
                redirectUri: window.location.origin,
                requiredUrlParams: ['scope'],
                optionalUrlParams: ['display'],
                scope: ['profile', 'email'],
                scopePrefix: 'openid',
                scopeDelimiter: ' ',
                display: 'popup',
                type: '2.0',
                popupOptions: { width: 452, height: 633 }
            });

            $authProvider.github({
                url: '/github/login',
                clientId: '13f81c8b888c1b57cc86',
                authorizationEndpoint: 'https://github.com/login/oauth/authorize',
                redirectUri: window.location.origin,
                optionalUrlParams: ['scope'],
                scope: ['user:email'],
                scopeDelimiter: ' ',
                type: '2.0',
                popupOptions: { width: 1020, height: 618 }
            });
        })
        .config(['markedProvider', 'hljsServiceProvider', function(markedProvider, hljsServiceProvider) {
            // marked config
            markedProvider.setOptions({
                gfm: true,
                tables: true,
                sanitize: true,
                highlight: function (code, lang) {
                    if (lang) {
                        return hljs.highlight(lang, code, true).value;
                    } else {
                        return hljs.highlightAuto(code).value;
                    }
                }
            });

            // highlight config
            hljsServiceProvider.setOptions({
                // replace tab with 4 spaces
                tabReplace: '    '
            });
        }])
    ;
})();