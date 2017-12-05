angular.module('myApp')
.service('message', function() {
    this.set = function (data, time) {
        localStorage.setItem('message', JSON.stringify(data));
        localStorage.setItem('time_message', time);
        console.log(time);
        console.log(localStorage.getItem('time_message'));
    }
    this.get = function(){
        var data = JSON.parse(localStorage.getItem('message'));
        if (localStorage.getItem('time_message') > 1) {
            var time = localStorage.getItem('time_message');
            localStorage.setItem('time_message', time-1);
        }else{
            this.remove();
        }
        return data;
    }
    this.remove = function() {
        localStorage.removeItem('message');
    }
});
