personnelmanagerApp.controller('practitioner_informationController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;
   
  $http.get('/admin/getThisPractitioner').success(function(fetchThisPractitioner){

    $scope.Practitioner = fetchThisPractitioner;

    document.getElementById("emptymsg_information").style.visibility = "visible";
    document.getElementById("thisPractitionerInfoLoad").style.display = "none";

  });

  $scope.numberOfPractitioners = function(){

    var count =0;

    angular.forEach($scope.AllPractitioners, function(practitioner) {
          count += 1;

        });

    return count;
  };

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
