personnelmanagerApp.controller('client_reportsController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;
   
  $http.get('/getClientReports').success(function(fetchClientReports){

    $scope.Reports = fetchClientReports;

    document.getElementById("emptymsg_reports").style.visibility = "visible";
    document.getElementById("thisClientReportsLoad").style.display = "none";

  });

  $scope.numberOfReports = function(){

    var count =0;

    angular.forEach($scope.Reports, function(reports) {
          count += 1;

        });

    return count;
  };

  }]);