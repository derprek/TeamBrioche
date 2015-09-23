reportApp.controller('ProgressFinishedController', ['$scope', '$http', function($scope, $http){

 $http.get('/getFinishedReports').success(function(fetchFinishedReports){

				$scope.FinishedReports = fetchFinishedReports;
				document.getElementById("finishedReportsLoad_text").style.display = "none";
				document.getElementById("finishedReportsLoad").style.display = "none";

				var count =0;

				angular.forEach($scope.FinishedReports, function(report) {
					count += 1;

				});

				if (count >= 1) {
				   
				   document.getElementById("finished_emptymsg").style.display = "none";
				   	
				}
				else
				{
					document.getElementById("finished_emptymsg").style.visibility = "visible";
				}
			});
}]);



