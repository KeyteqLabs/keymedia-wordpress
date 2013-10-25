'use strict';

angular.module('keymediaApp', [])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: '/wp-content/plugins/keymedia/web/app/views/main.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
