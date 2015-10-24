clientApp.controller('clientController', ['$scope', '$http', function($scope, $http){

	$scope.showForm = true;
    $scope.loadingSpinner = false;

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

 	$scope.showLoadingAnimation = function() {

      	$scope.showForm = false;
      	$scope.loadingSpinner = true;
      };


}]);
