angular.module('myApp')
.run(function($rootScope, $state, message) {
    $rootScope.$on('$locationChangeSuccess', function() {
        $rootScope.message = message.get();
    })
});
