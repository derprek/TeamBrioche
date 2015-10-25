@extends('mailboxMaster')

@section('sidemenubar')
    @if((Session::has('is_admin')) && (Session::has('prac_id')))
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="{{ url('admin/personnelmanager') }}"><i class="fa fa-users"></i> Personnel Manager</a>
                </li>
                <li>
                    <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
                </li>
                <li>
                    <a href="{{ url('admin/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
                </li>
            </ul>
        </div>
    
    @elseif(Session::has('prac_id'))
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
                </li>
                <li>
                    <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
                </li>
            </ul>
        </div>

    @elseif(Auth::check())

        <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li>
                <a href="{{ url('client/reportarchives') }}"><i class="fa fa-bar-chart-o"></i> Reports</a>
            </li>
        </ul>
    </div>

    @endif
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
                        <li><a href="/../mailbox"><i class="fa fa-inbox"></i> Inbox</a></li>
                        <li class="active"> View Thread</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

    <div class="row">
    <br>
        <div class="col-sm-2 col-md-1">
             <a href="#" class="btn btn-success btn-sm btn-block" role="button" ng-click="startAdd()"> <i class="fa fa-pencil"></i> <p style="font-size:1em;">Compose</p></a>
            <hr />
            
            <a class="directionLinks pull-left" href="/../mailbox"> <i class="fa fa-chevron-left"></i>  Mailbox </a>
            
        </div>


        <div id="loadthreadpage" style="width:100%; ">
                               
            @include('partials.loadinganimation')

            <div id="loadthreadpage_text" style="margin-left:45%;">
                <small>
                    Fetching your Messages....
                </small>
            </div>
        </div>

        <div class="col-sm-10 col-md-11" ng-cloak>
            <!-- Nav tabs -->
             <toaster-container ></toaster-container>
                    
                    <div class="row" style="overflow: auto;margin-bottom:1%;margin-right:1%;"> 
                        <p ng-if="totalunreadmessages()" ><small style="font-size:0.7em;float:right;">You have (@{{totalunreadmessages()}}) unread messages.</small></p>
                    </div>

                    <small class="mailboxfontmedium pull-right"ng-show="AllMessages"> 
                         Messages with: @{{recipient_email()}} 
                    </small>
                    <br><br>

                     <input ng-show="AllMessages" type="text" placeholder="Search...." class="form-control"
                                   ng-model="search.text"><br>

                    <div ng-show="(AllMessages | filter:search.text).length == 0" class="emptymsg_container">
                        <h3> No Results found.</h3>
                    </div>
                    
                        <uib-accordion close-others="false" >
                       
                       <span dir-paginate="message in AllMessages | filter:search.text |  itemsPerPage: 5" pagination-id="threadPagination" style="padding:3px;" >

                        <uib-accordion-group  panel-class="panel-info" is-open="true" ng-if="message.sender_email !== 'You' && message.status === 'unread'">
                          <uib-accordion-heading>
                           <span class="pull-left" style="width:20%;">From: @{{ message.sender_name }} </span>  
                            <span>@{{ message.title }} </span>  
                            <p class="mailboxfontmedium pull-right"> @{{ message.created_at  }} </p>
                          </uib-accordion-heading>
                          @{{ message.content }}
                        </uib-accordion-group>

                        <uib-accordion-group  is-open="true" ng-if="totalunreadmessages() !== '0' && message.id === getfirstID()">
                          <uib-accordion-heading id="firstmessage">
                           <span class="pull-left" style="width:20%;">From: @{{ message.sender_name }} </span>  
                            <span> @{{ message.title }} </span>  
                            <p class="mailboxfontmedium pull-right"> @{{ message.created_at  }} </p> 
                          </uib-accordion-heading>
                          @{{ message.content }}
                        </uib-accordion-group>

                        <span ng-if="(message.sender_email === 'You' || message.status !== 'unread')">
                        <uib-accordion-group  is-open="false" ng-if=" message.id !== getfirstID()">
                          <uib-accordion-heading>
                            <span class="pull-left" style="width:20%;"> From: @{{ message.sender_name }} </span>  
                            <span> @{{ message.title }} </span>  
                            <p class="mailboxfontmedium pull-right"> @{{ message.created_at  }} </p>
                          </uib-accordion-heading>
                          @{{ message.content }}
                        </uib-accordion-group>
                        </span>

                        </span>

                      </uib-accordion>
                    
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