angular.module('myApp')
.controller('LoginController', function($scope, $rootScope, $location, auth, message){
    $scope.login = function(){
        var data = {
            username : ($scope.username) ? $scope.username : "",
            password : ($scope.password) ? $scope.password : ""
        };
        auth.login(data)
        .then(function(res){
            if (res.valid) {
                message.set({
                    type : "success",
                    content : res.message
                }, 1);
                $location.path('/');
            }else{
                $rootScope.message = ({
                    type : "danger",
                    content : res.message
                });
            }
        });
    }
});
