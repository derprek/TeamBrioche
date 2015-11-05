messengerApp.controller('masterMessageController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  angular.element(document).ready(function () {
        $scope.newMessage = {};
        $scope.getUnread();
        $scope.getRecipients();   
    });

  $scope.getUnread = function() {

    $http.get('/getUnreadMessages').success(function(fetchUnread){

        $scope.Unread = fetchUnread;

    });
  };

  $scope.totalunread = function() {

        var unreadcount =0;

        angular.forEach($scope.Unread, function() {
          unreadcount += 1;

        });

        return unreadcount;

    };

   $scope.getRecipients = function() {

   $http.get('/getAllRecipients').success(function(fetchAllRecipients){

        $scope.RecipientList = fetchAllRecipients;
        $scope.newMessage.recipient = $scope.RecipientList[0];

    });
   };

  $scope.startAdd = function() {
    $scope.newWindow = true;
  };

  $scope.cancelAdd = function() {
    $scope.newWindow = false;
  };

  $scope.sendMessage = function() {
    $scope.newWindow = false;

    toastr.clear();
    toastr.info('Sending...');

    var newMessage ={
        conv_id: '1', 
        receiver_email:$scope.newMessage.recipient.email,
        title:$scope.newMessage.title,
        content:$scope.newMessage.content,
        status:'unread'
    };

     $http.post('/newMessage', newMessage)

     .success(function(){ 

       toastr.clear();
       toastr.success('Your message has been sent.','Success!',
        {
          closeButton: true
        });

      })

     .error(function(){ 

      toastr.clear();
      toastr.error('There was an error trying to send your message :(','Failed!');

      });
  };

  setInterval($scope.getUnread, 3000);

  }]);