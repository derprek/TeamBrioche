var reportApp = angular.module('reportApp',['angularUtils.directives.dirPagination']).config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }]);

 angular.element(document).ready(function() {
      angular.bootstrap(document.getElementById('reportApp'), ['reportApp']);
    }); 
