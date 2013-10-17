'use strict';

angular.module('keymediaApp')
  .controller('MainCtrl', function ($scope) {
      
      $scope.details = null;
      $scope.mediaFiltered = 0;
      
      $scope.media = [
          {
              'selected': true,
              'details': true,
              'url': 'http://keymedia.wp.dev/wordpress/wp-content/uploads/2013/10/1185449_10151773166079190_2014642851_n-294x300.jpg'
          },
          {
              'url': 'http://keymedia.wp.dev/wordpress/wp-content/uploads/2013/10/1384061_10151871638399190_355918051_n-300x225.jpg'
          }
      ];
      
      $scope.deselect = function(medium) {
          medium.selected = false;
          if(medium.details) {
              $scope.details = null;
              medium.details = false;
          }
          return false;
      };
      
      $scope.deselectAll = function() {
          angular.forEach($scope.media, function (v, k) {
             v.details = false;
             v.selected = false;
          });
          $scope.details = null;
          return false;
      };
      
      $scope.select = function(medium) {
          angular.forEach($scope.media, function(v, k) {
              v.details = false;
              v.selected = false;
          });
          medium.details = true;
          medium.selected = true;
          $scope.details = medium;
          return false;
      };
      
      $scope.attach = function() {
        var win = window.dialogArguments || opener || parent || top;
        var imgSrc = $scope.details.url;
        win.send_to_editor('<img src="' + imgSrc + '" />');
      };
  });
