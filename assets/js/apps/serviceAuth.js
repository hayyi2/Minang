angular.module('myApp')
.service('auth', function($http, $rootScope, $location, $state, message) {
    this.login = function (data) {
        return res = $http({
            method : 'POST',
            url : API + "login",
            headers : {},
            data : data
        }).then(function successCallback(response) {
            localStorage.setItem('auth', JSON.stringify({
                userid : response.data.userid,
                token : response.data.token
            }));
            return {
                valid : true,
                message : "Success Login."
            }
        }, function errorCallback(response) {
            return {
                valid : false,
                message : response.data
            }
        });
    }

    this.userCan = function() {
        if (!this.isLogin()) {
            return $state.go('login');
        }
    }

    this.mushLoginMessage = function(){
        message.set({
            type : "danger",
            content : "You must login."
        },2);
    }

    this.isLogin = function(){
        return (!!localStorage.getItem('auth'));
    }

    this.logout = function(){
        localStorage.removeItem('auth');
        message.set({
            type : "success",
            content : "Succes Log Out"
        },1);
        $location.path('/login');
    }
});
