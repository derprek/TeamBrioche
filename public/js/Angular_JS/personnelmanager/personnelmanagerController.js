personnelmanagerApp.controller('personnelmanagerController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;
  $scope.showForm = true;
  $scope.loadingSpinner = false;
  $scope.selected={}; 
   
  $http.get('/admin/getAllPractitioners').success(function(fetchAllPractitioners){

    $scope.AllPractitioners = fetchAllPractitioners;
    $scope.selected.practitioner = $scope.AllPractitioners[0];

    document.getElementById("emptymsg_practitioners").style.visibility = "visible";
    document.getElementById("allPractitionersLoad").style.display = "none";

  });

  $http.get('/admin/getAllClients').success(function(fetchAllClients){

    $scope.AllClients = fetchAllClients;

    document.getElementById("emptymsg_clients").style.visibility = "visible";

    document.getElementById("allClientsLoad_text").style.display = "none";
    document.getElementById("allClientsLoad").style.display = "none";

  });

  $scope.numberOfPractitioners = function(){

    var count =0;

    angular.forEach($scope.AllPractitioners, function(practitioner) {
          count += 1;

        });

    return count;
  };

  $scope.showLoadingAnimation = function() {

        $scope.showForm = false;
        $scope.loadingSpinner = true;
      
      };

  }]);
