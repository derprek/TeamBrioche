reportApp.controller('MyReportsController', [ '$http', '$scope', function($http, $scope){

  $scope.currentPage = 1;
  $scope.pageSize = 10;

  $http.get('/getMyReports').success(function(fetchMyReports){

        $scope.AllReports = fetchMyReports;

        document.getElementById("allReportsLoad_text").style.display = "none";
        document.getElementById("allReportsLoad").style.display = "none";
        document.getElementById("addreport_btn").style.visibility = "visible";

        var count =0;

        angular.forEach($scope.AllReports, function(report) {
          count += 1;

        });

        if (count >= 1)
        {
           document.getElementById("emptymsg").style.display = "none";
        }
        else
        {
          document.getElementById("emptymsg").style.visibility = "visible";
        }
    });

  }]);


