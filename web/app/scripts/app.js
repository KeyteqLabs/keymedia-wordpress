'use strict';

angular.module('keymediaApp', ['angularFileUpload'])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/:album', {
        templateUrl: '/wp-content/plugins/keymedia/web/app/views/main.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
