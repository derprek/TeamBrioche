personnelmanagerApp.controller('practitioner_reportsController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;
   
  $http.get('/admin/getPractitionerReports').success(function(fetchPractitionerReports){

    $scope.Reports = fetchPractitionerReports;

    document.getElementById("emptymsg_reports").style.visibility = "visible";
    document.getElementById("thisPractitionerReportsLoad").style.display = "none";

  });

  $scope.numberOfReports = function(){

    var count =0;

    angular.forEach($scope.Reports, function(reports) {
          count += 1;

        });

    return count;
  };

  }]);