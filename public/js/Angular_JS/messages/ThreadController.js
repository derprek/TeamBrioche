messengerApp.controller('ThreadController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;
  $scope.getMyMessages();

  $scope.getMyMessages = function() {
         
        $http.get('/getMyMessages').success(function(fetchAllMessages){

        $scope.AllMessages = fetchAllMessages;

       var conv_id = { conv_id: $scope.AllMessages[0].conv_id };

       $http.post('/../practitioner/readmessages',conv_id);
        
        document.getElementById("emptymsg").style.visibility = "visible";
    })
      };

 $scope.recipient_email = function() {
         
        var recipient_email = $scope.AllMessages[0].recipient_email;
        return recipient_email;
      };


  $scope.totalunread = function() {

      var unreadcount = 0;

        angular.forEach($scope.AllMessages, function(messages) {
         
          unreadcount += messages.is_unread ? 1 : 0;

        });
        
        return unreadcount;
      };

  $scope.totalmessages = function() {

      var totalcount = 0;

        angular.forEach($scope.AllMessages, function(messages) {
          totalcount += 1;

        });
        
        return totalcount;
      };

  $scope.startAdd = function() {
    $scope.newWindown = true;
  };

  $scope.cancelAdd = function() {
    $scope.newWindown = false;
  };

  $scope.sendMessage = function() {
    $scope.newWindown = false;

    toastr.clear();
    toastr.info('Sending...');
 

    var newMessage ={
        conv_id: '1',
        receiver_email:$scope.newMessage.name,
        title:$scope.newMessage.title,
        content:$scope.newMessage.content,
        status:'unread'
    };

     $http.post('/../practitioner/newMessage', newMessage)

     .success(function(newMessage){ 

       $scope.AllMessages.unshift(newMessage);
       toastr.clear();
       toastr.success('Your message has been sent.','Success!',
        {
          closeButton: true
        });

      })

     .error(function(newMessage){ 

      toastr.clear();
      toastr.error('There was an error trying to send your message :(','Failed!');
      $scope.AllMessages.pop();

      });

    
  };

  }]);