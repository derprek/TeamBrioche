var personnelmanagerApp = angular.module('personnelmanagerApp',['angularUtils.directives.dirPagination','toastr','ngAnimate','ngSanitize','ui.select']).config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }]);

 angular.element(document).ready(function() {
      angular.bootstrap(document.getElementById('personnelmanagerApp'), ['personnelmanagerApp']);
    }); 

