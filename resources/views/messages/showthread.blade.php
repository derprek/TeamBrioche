@extends('master.mailbox')

@section('sidemenubar')
   
    @include('partials.sidebar_home')

@endsection

@section('content')
<script src="/js/Angular_JS/messages/MailboxController.js"></script>

<div id="page-wrapper">
    <div class="container-fluid">
      
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    &nbsp;
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/../mailbox"><i class="fa fa-inbox"></i> Inbox</a></li>
                    <li class="active"> View Thread</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <br><br>
            <div class="col-sm-2 col-md-2 col-lg-2">
                <div ng-cloak class="col-lg-9">
                  <a href="#" class="btn btn-success btn-sm btn-block" role="button" ng-click="startAdd()"> <i class="fa fa-pencil"></i> <p style="font-size:1em;">Compose</p></a>
                  <hr>
                  <a class="directionLinks pull-left" href="/../mailbox"> <i class="fa fa-chevron-left"></i>  Mailbox </a>
                </div>
            </div>
       

        <div id="loadthreadpage">
                               
            @include('partials.loadinganimation')

            <div id="loadthreadpage_text" class="text-center">
                <small>
                    Fetching your Messages....
                </small>
            </div>
        </div>

        <div class="col-sm-10 col-md-10" ng-cloak>
            <!-- Nav tabs -->
             <toaster-container ></toaster-container>
                    
                  <div class="row" style="overflow: auto;margin-bottom:1%;margin-right:1%;"> 
                      <p ng-if="totalunreadmessages()">
                        <small style="font-size:0.7em;float:right;">You have (@{{totalunreadmessages()}}) unread messages.</small>
                      </p>
                  </div>

                  <small class="mailboxfontmedium pull-right"ng-show="AllMessages"> 
                      Messages with: @{{recipient_email()}} 
                  </small>

                  <br><br>

                  <input ng-show="AllMessages" type="text" placeholder="Search...." class="form-control" ng-model="search.text"><br>
                    
                  <uib-accordion close-others="false" >
                       
                    <span dir-paginate="message in AllMessages | filter:search.text |  itemsPerPage: 5" pagination-id="threadPagination" style="padding:3px;" >

                    <!-- checks if this message is unread & user is the receiver  -->

                      <uib-accordion-group  panel-class="panel-info" is-open="true" ng-if="message.sender_email !== 'You' && message.status === 'unread'" >
                        <uib-accordion-heading>
                         <span class="pull-left" style="width:20%;font-size: 0.9em;">From: @{{ message.sender_name }} </span>
                          <span>@{{ message.title }} </span>  
                          <p class="mailboxfontmedium pull-right"> @{{ message.created_at  }} </p>
                        </uib-accordion-heading>
                        @{{ message.content }}
                      </uib-accordion-group>

                    <!-- End -->

                    <!-- checks if this conversation has no unread & is the first message in the conversation  -->

                      <uib-accordion-group  is-open="true" ng-if="totalunreadmessages() === 0  && message.id === getfirstID()">
                        <uib-accordion-heading id="firstmessage">
                         <span class="pull-left" style="width:20%; font-size: 0.9em;">From: @{{ message.sender_name }} </span>
                          <span> @{{ message.title }} </span>  
                          <p class="mailboxfontmedium pull-right"> @{{ message.created_at  }} </p> 
                        </uib-accordion-heading>
                        @{{ message.content }}
                      </uib-accordion-group>

                    <!-- End  -->

                    <!-- checks if this message is not the first and not unread + sent by the user  -->

                      <span ng-if="message.id !== getfirstID()" >
                        <uib-accordion-group is-open="false" ng-if="message.sender_email === 'You' || message.status !== 'unread' ">
                          <uib-accordion-heading>
                            <span class="pull-left" style="width:20%;font-size: 0.9em;"> From: @{{ message.sender_name }} </span>
                            <span> @{{ message.title }} </span>  
                            <p class="mailboxfontmedium pull-right"> @{{ message.created_at  }} </p>
                          </uib-accordion-heading>
                          @{{ message.content }}
                        </uib-accordion-group>
                      </span>

                    <!-- End  -->

                    </span>

                  </uib-accordion>

                  <div ng-if="AllMessages">
                      <div ng-show="(AllMessages | filter:search.text).length == 0" class="emptyresults_container">
                           <h3> No results found <i class="fa fa-meh-o"></i> </h3>
                      </div>
                  </div>
                    
                  <dir-pagination-controls template-url="/dirPagination.tpl.html" pagination-id="threadPagination"></dir-pagination-controls>  
        </div>
      </div>
        <!-- /.col-12-content -->
  </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<script type="text/javascript">
  $( document ).ready(function() {
      angular.element('#wrapper').scope().getMyMessages();
  });
</script>
    
@endsection

@stop