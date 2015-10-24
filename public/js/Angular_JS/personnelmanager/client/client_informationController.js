personnelmanagerApp.controller('client_informationController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;
   
  $http.get('/getThisClient').success(function(fetchThisClient){

    $scope.Client = fetchThisClient;

    document.getElementById("thisClientInfoLoad").style.display = "none";

  });

  $scope.confirmationPassed = function(){

    if($scope.deleteconfirmation == 'delete')
    {
      return true;
    }
    else
    {
       return false;
    }

  };

  }]);
