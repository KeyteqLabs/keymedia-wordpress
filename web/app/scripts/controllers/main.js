'use strict';

angular.module('keymediaApp')
  .controller('MainCtrl', function ($scope, $http, $routeParams, $location) {
      
      $scope.details = null;
      $scope.mediaFiltered = 0;
      $scope.media = [];
      
      var album = $routeParams.album;
      
      var mediaUrl = 'media-upload.php?tab=keymedia&rest=list_media';
      
      if(album != '') {
        mediaUrl += '&album=' + album
      }
      
      $scope.$watch('search', function() {
        var searchUrl = mediaUrl;
        if($scope.search) {
	  searchUrl = mediaUrl + '&search=' + $scope.search;
	}
        $http.get(searchUrl).success(function(data){
            $scope.media = data;
        });
      });
      
      $http.get('media-upload.php?tab=keymedia&rest=list_albums').success(function(data){
	  $scope.albums = data;
      });
      
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
      
      // TODO: refactor me
      $scope.select = function(medium, $event) {
	  var shiftHold = $event.shiftKey;
	  var ctrlHold = $event.ctrlKey;
	  
	  if(shiftHold) {
	    var selectMode = false;
	    angular.forEach($scope.media, function(v, k) {
		if(v === medium || v.details) {
		  selectMode = !selectMode;
		}
		v.details = false;
		v.selected = v.selected || selectMode;
	    });
	    medium.details = true;
	    medium.selected = true;
	  }
	  else if(ctrlHold) {
	    angular.forEach($scope.media, function(v, k) {
	      v.details = false;
	    });
	    medium.selected = !medium.selected;
	    medium.details = medium.selected;
	    if(medium.details) {
	      $scope.details = medium;
	    }
	    else {
	      $scope.details = null;
	    }
	    
	  }
	  else {
	    angular.forEach($scope.media, function(v, k) {
		v.details = false;
		v.selected = false;
	    });
	    medium.details = true;
	    medium.selected = true;
	    $scope.details = medium;
	  }
          return false;
      };
      
      $scope.attach = function() {
        var win = window.dialogArguments || opener || parent || top;
        var imgSrc = $scope.details.file.url;
	if($scope.details.isImage) { 
	      win.send_to_editor('<img src="' + imgSrc + '" />');
	}
      };
      
      $scope.goToAlbum = function(album) {
        $location.path(album);
	return false;
      };
      
      
      
  });
