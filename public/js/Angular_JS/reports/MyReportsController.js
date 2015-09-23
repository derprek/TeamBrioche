reportApp.controller('MyReportsController', [ '$http', '$scope', function($http, $scope){

  $scope.currentPage = 1;
  $scope.pageSize = 10;

  $http.get('/getAllReports').success(function(fetchAllReports){

        $scope.AllReports = fetchAllReports;

        document.getElementById("allReportsLoad_text").style.display = "none";
        document.getElementById("allReportsLoad").style.display = "none";

        var count =0;

        angular.forEach($scope.AllReports, function(report) {
          count += 1;

        });

        if (count >= 1) {
           
           document.getElementById("emptymsg").style.display = "none";
            
        }
        else
        {
          document.getElementById("emptymsg").style.visibility = "visible";
        }
    });

  }]);


