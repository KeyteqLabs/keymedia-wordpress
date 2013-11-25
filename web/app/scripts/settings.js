'use strict';

angular.module('keymediaSettingsApp', [])
        .directive('ngInitial', function() {
            return {
                restrict: 'A',
                controller: [
                    '$scope', '$element', '$attrs', '$parse', function($scope, $element, $attrs, $parse) {
                        var getter, setter, val;
                        val = $attrs.ngInitial || $attrs.value;
                        getter = $parse($attrs.ngModel);
                        setter = getter.assign;
                        setter($scope, val);
                    }
                ]
            };
        })
        .controller('SettingsCtrl', function($scope, $http) {
            $scope.connection = true;
            $scope.$watch('settings', function() {
                $http.get('media-upload.php?tab=keymedia&rest=check_connection', {params: $scope.settings}).success(function(data) {
                    $scope.connection = 'true'===data;
                });
            }, true);
            $scope.getToken = function() {
                $http.get('media-upload.php?tab=keymedia&rest=get_token', {params: $scope.settings}).success(function(data) {
                    if(data && data != "false") {
                       $scope.settings.token = JSON.parse(data);
                    }
                });
            };
            $scope.removePassword = function() {
                $scope.settings.password = '';
            };
        });
