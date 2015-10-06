personnelmanagerApp.controller('client_informationController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;
   
  $http.get('/admin/getThisClient').success(function(fetchThisClient){

    $scope.Client = fetchThisClient;

    document.getElementById("emptymsg_information").style.visibility = "visible";
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
