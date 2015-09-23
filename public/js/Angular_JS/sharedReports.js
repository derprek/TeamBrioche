myApp.controller('SharedReportsController', ['$scope', '$http', function($scope, $http){

 $http.get('/getSharedReports').success(function(fetchSharedReports){

				$scope.SharedReports = fetchSharedReports;
				document.getElementById("sharedReportsLoad_text").style.display = "none";
				document.getElementById("sharedReportsLoad").style.display = "none";

				var count =0;

				angular.forEach($scope.SharedReports, function(report) {
					count += 1;

				});

				if (count >= 1) {
				   
				   document.getElementById("shared_emptymsg").style.display = "none";
				   	
				}
				else
				{
					document.getElementById("shared_emptymsg").style.visibility = "visible";
				}

			});
}]);
