angular.module('myApp')
.controller('mainControl', function($scope, $rootScope, message){
	$scope.close_alert = function(){
		$rootScope.message = false;
	}
});
