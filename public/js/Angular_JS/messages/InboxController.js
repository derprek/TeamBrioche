messengerApp.controller('InboxController', [ '$http', '$scope','toastr', function($http, $scope,toastr){

  $scope.currentPage = 1;
  $scope.pageSize = 10;

  $scope.errorText = "Talk to someone.";

  angular.element(document).ready(function () {
        $scope.newMessage = {};
        $scope.getInbox();
        $scope.getRecipients();   
    });

  $scope.totalunread = function() {

      var unreadcount = 0;

        angular.forEach($scope.Inbox, function(inbox) {
          unreadcount += inbox.has_unread ? 1 : 0;

        });
        
        return unreadcount;
      };

  $scope.getInbox = function() {

    $http.get('/getMyInbox').success(function(fetchInbox){

        $scope.Inbox = fetchInbox;

        document.getElementById("loadInbox").style.display = "none";
        document.getElementById("loadInbox_text").style.display = "none";

        var count =0;

        angular.forEach($scope.Inbox, function(inbox) {
          count += 1;

        });

        if (count >= 1) 
        {
           document.getElementById("emptymsg").style.display = "none";            
        }
        else
        {
           document.getElementById("emptymsg").style.visibility = "visible";
        }
    });
  };

   $scope.getRecipients = function() {

   $http.get('/getAllRecipients').success(function(fetchAllRecipients){

        $scope.RecipientList = fetchAllRecipients;
        $scope.newMessage.recipient = $scope.RecipientList[0];

    });
   };

  $scope.getSentBox = function() {

    $http.get('/getMySentbox').success(function(fetchSentbox){

        $scope.Sentbox = fetchSentbox;

        document.getElementById("loadSentbox").style.display = "none";
        document.getElementById("loadSentbox_text").style.display = "none";

        var count =0;

        angular.forEach($scope.Sentbox, function(inbox) {
          count += 1;

        });

        if (count >= 1) 
        {
          document.getElementById("emptymsg_send").style.display = "none";
        }
        else
        {
          document.getElementById("emptymsg").style.visibility = "visible";
        }
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

       $scope.getSentBox();
       $scope.errorText = "Your Message has been sent.";
       toastr.clear();
       toastr.success('Your message has been sent.','Success!',
        {
          closeButton: true
        });

          TweenMax.staggerFrom("#sendbox", 2, {scale:0.5, opacity:0, delay:0.3, ease:Elastic.easeOut, force3D:true}, 0.2);

      })

     .error(function(){ 

      toastr.clear();
      toastr.error('There was an error trying to send your message :(','Failed!');

      });

    
  };

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

   $scope.totalunreadmessages = function() {

      var unreadcount = 0;

        angular.forEach($scope.AllMessages, function(messages) {
         
          unreadcount += messages.is_unread ? 1 : 0;

        });
        
        return unreadcount;
      };





  }]);