clientApp.controller('AllClientsController', ['$scope', '$http', function($scope, $http){

 $http.get('/getAllClients').success(function(fetchAllClients){

				$scope.AllClients = fetchAllClients;
				document.getElementById("allClientsLoad_text").style.display = "none";
				document.getElementById("allClientsLoad").style.display = "none";

				var count =0;

				angular.forEach($scope.AllClients, function(client) {
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
