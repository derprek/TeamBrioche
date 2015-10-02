@extends('pracinbox_master')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li>
                <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
            </li>
            <li class="active">
                <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
            </li>
            <li>
                <a href="{{ url('practitioner/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/0.4.9/toaster.min.css" rel="stylesheet" />
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-bar-chart"></i> <a href="{{ url('practitioner/reportmanager') }}">Report
                                Manager</a>
                        </li>

                    </ol>
                </div>
            </div>
            <!-- /.row -->

    <div class="row">
    <hr>
        <div class="col-sm-2 col-md-1">
             <a href="#" class="btn btn-success btn-sm btn-block" role="button" ng-click="startAdd()"> <i class="fa fa-pencil"></i> <p style="font-size:1em;">Compose</p></a>
            <hr />
            
                <a href="/../practitioner/inbox" class="btn btn-primary btn-sm btn-block" ><i style="margin-right:5%;" class="fa fa-angle-left"></i>   <small style="font-size:1.1em;">Inbox </small></a>
                
            
        </div>
        <div class="col-sm-10 col-md-11">
            <!-- Nav tabs -->
             <toaster-container ></toaster-container>
                    
                    <div class="row" style="overflow: auto;margin-bottom:1%;margin-right:1%;"> <p ng-if="totalunreadmessages()" ><small style="font-size:0.7em;float:right;">You have (@{{totalunreadmessages()}}) unread messages.</small></p></div>
                    <a role="button" ng-show="AllMessages" data-toggle="collapse" href="#moreinfo" aria-expanded="false" aria-controls="moreinfo"><div class="row" style="overflow: auto;margin-bottom:1%;margin-right:1%;">  <small style="font-size:0.7em;float:right;">More Info <i class="fa fa-chevron-down"></i> </small></div></a>
                    <div class="collapse" id="moreinfo">
                            <div class="well">
                              <small> Recipient Email address: @{{recipient_email()}} </small><br>
                              <small> Total number of messages: @{{totalmessages()}} </small>
                            </div>
                        </div>

                     <input ng-show="AllMessages" type="text" placeholder="Search...." class="form-control"
                                   ng-model="search.text"><br>

                    <div ng-show="(AllMessages | filter:search.text).length == 0" class="emptymsg_container">
                        <p id="emptymsg">No Results found.</p>
                    </div>
                    
                    <div class="list-group" dir-paginate="message in AllMessages | filter:search.text |  itemsPerPage: 5" pagination-id="threadPagination">
                        
                        <div class="panel " ng-if="message.sender_email !== 'You' && message.status === 'unread'"> 
                        <div style="background-image: none;background-color: #59ABE3;color: white;" class="panel-heading"><small>From: @{{ message.recipient_name }}</small> <strong style="padding-left:3%;">@{{ message.title }}</strong></div>
                        <div class="panel-body">
                           <small>@{{ message.content }}</small>
                        </div>

                        <div class="panel-footer"><small style="font-size:0.7em;">@{{ message.created_at }}</small></div>
                        <hr>
                        </div>


                        <div class="panel" ng-if="message.sender_email === 'You' || message.status !== 'unread'"> 
                        <div style="background-image: none;background-color: #6C7A89;color: white;" class="panel-heading"><small>From: @{{ message.recipient_name }}</small> <strong style="padding-left:3%;">@{{ message.title }}</strong></div>
                        <div class="panel-body">
                           <small>@{{ message.content }}</small>
                        </div>

                        <div class="panel-footer" style="float-right;"><small style="font-size:0.7em;">@{{ message.created_at }}</small></div>
                        <hr>
                        </div>                              
                    </div>
                    
                    <dir-pagination-controls template-url="/dirPagination.tpl.html"
                        pagination-id="threadPagination"></dir-pagination-controls>
            </div>
            <!-- Ad -->         

            </div>
            <!-- /.col-12-content -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <br>
    <script type="text/javascript">
      $( document ).ready(function() {
          angular.element('#wrapper').scope().getMyMessages();
      });
    </script>
@endsection

@stop