reportApp.controller('ProgressReportsController', ['$scope', '$http', function($scope, $http){

 $http.get('/getProgressReports').success(function(fetchProgressReports){

				$scope.ProgressReports = fetchProgressReports;
				document.getElementById("progressReportsLoad_text").style.display = "none";
				document.getElementById("progressReportsLoad").style.display = "none";

				var count =0;

				angular.forEach($scope.ProgressReports, function(report) {
					count += 1;

				});

				if (count >= 1) {
				   
				   document.getElementById("progress_emptymsg").style.display = "none";
				   	
				}
				else
				{
					document.getElementById("progress_emptymsg").style.visibility = "visible";
				}

			});
}]);

