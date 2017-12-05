angular.module('myApp')
.config(function($stateProvider, $urlRouterProvider, $locationProvider){
	$urlRouterProvider.otherwise('/');

	$stateProvider
	.state('dashboard', {
		url: "/",
		resolve: {
			check : function($location, auth){
				if (!auth.isLogin()) {
					auth.mushLoginMessage();
					$location.path('/login');
				}
			},
		},
        abstract: "user",
        templateUrl:'partial/template.html',
	})
	.state('dashboard.index', {
		url: "",
		templateUrl:'partial/dashboard.html',
	})
	.state('dashboard.post', {
		url: "post",
		templateUrl:'partial/list-data.html',
		controller:'DataController',
	})
	.state('dashboard.user', {
		url: "user",
		templateUrl:'partial/list-user.html',
		controller:'UserController',
	})
	.state('login', {
		url: "/login",
		templateUrl:'partial/login.html',
		controller:'LoginController',
	})
	.state('logout', {
		url: "/logout",
		controller : function(auth){ auth.logout();},
	});

	$locationProvider.html5Mode(true);
});
