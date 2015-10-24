personnelmanagerApp.controller('practitioner_clientsController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;
   
  $http.get('/admin/getPractitionerClients').success(function(fetchAllClients){

    $scope.Clients = fetchAllClients;

    document.getElementById("emptymsg_clients").style.visibility = "visible";
    document.getElementById("thisPractitionerClientsLoad").style.display = "none";

  });

  $scope.numberOfClients = function(){

    var count =0;

    angular.forEach($scope.Clients, function(practitioner) {
          count += 1;

        });

    return count;
  };

  }]);
