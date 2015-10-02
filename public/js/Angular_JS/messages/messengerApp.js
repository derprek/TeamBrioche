var messengerApp = angular.module('messengerApp',['angularUtils.directives.dirPagination','toastr','ngAnimate','ngSanitize','ui.select']).config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }]);