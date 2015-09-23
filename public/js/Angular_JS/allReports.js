myApp.controller('ReportsController', ['$scope', '$http', function($scope, $http){

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

 $scope.remaining = function(){
				

				
			}

}]);
