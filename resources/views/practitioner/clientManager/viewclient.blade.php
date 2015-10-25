@extends('adminmaster')

@section('sidemenubar')

 @if(Session::has('is_admin'))

       <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="active">
                    <a href="{{ url('admin/personnelmanager') }}"><i class="fa fa-users"></i> Personnel Manager</a>
                </li>
                <li>
                    <a href="{{ url('admin/questionmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
                </li>
                <li>
                    <a href="{{ url('admin/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
                </li>
            </ul>
        </div>
    
    @else

        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="active">
                    <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
                </li>
                <li>
                    <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
                </li>
            </ul>
        </div>

    @endif

    
@endsection

@section('content')

@if(Session::has('successful_registration'))
    <script>
        BootstrapDialog.show({
            title: 'Success',
            message: '{{ Session::pull('successful_registration')}} <strong>{{ Session::pull('email')}}.</strong> <br><br> <strong>The default password is: {{ Session::pull('defaultpassword')}}</strong>' ,
            type: BootstrapDialog.TYPE_SUCCESS,
            buttons: [{
                label: 'Close',
                cssClass: 'btn-default',
                action: function (dialogItself) {
                    dialogItself.close();
                }

            }]
        });
    </script>
@endif
           
    <div >
        <div id="personnelmanagerApp" class="container-fluid">

        <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    @if(Session::has('is_admin'))
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-users"></i> Personnel Manager
                        </li>
                        <li class="active">
                            <i class="fa fa-user"></i> View Client
                        </li>
                    </ol>
                    @else
                        <ol class="breadcrumb">
                            <li>
                                <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i> View Client
                            </li>
                        </ol>
                    @endif
                </div>
            </div>
            <!-- /.row -->

             <div class="col-lg-12">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Personal Information</a></li>
                    <li><a data-toggle="tab" href="#reports">Reports</a></li>
                </ul>

             <div class="tab-content">
                  
                <div id="home" class="tab-pane fade in active">

            <div ng-controller="client_informationController">
                    
                <div id = "thisClientInfoLoad" style = "width:100%; ">
                     
                    @include('partials.loadinganimation')

                    <div id = "thisClientInfoLoad_text" style="margin-left:45%;">
                         <small style="margin:auto;"  >
                            Fetching Client Information....
                        </small>
                    </div>
                </div>

            <div class="col-sm-10 col-md-10 col-lg-12" ng-cloak ng-show="Client">
            <form role="form" method="POST" action="{{ url('/practitioner/updateClient') }}">

                <div class="form-group" ng-cloak>

                    @if (Session::has('client_updateerror'))
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>                                     
                                    <li>The email has already been taken.</li>
                            </ul>
                        </div>
                    @endif


                <input type="hidden" name="id" class="form-control" value="@{{ Client.id }}" required>
                <br>

                <label>First Name:<input type="text" name="fname" class="form-control" value="@{{ Client.fname }}" required>   </label>
                <br>

                <label>Family Name:<input type="text" name="sname" class="form-control" value="@{{ Client.sname }}" required> </label>
                <br>

                <label> Registered Email Address: <input type="email" name="email" value="@{{ Client.email }}" class="form-control" required> </label>
                <br><br>

                <input type="submit" value="Update" class="btn btn-primary btn-sm ">

            </form>

                <h3> Under the supervision of: </h3>
                <hr>
                <label>Practitioner Name:<input type="text" name="prac_name" class="form-control" value="@{{ Client.prac_name }}" readonly> </label>
                <br>
                <label>Email Address:<input type="text" name="prac_email" class="form-control" value="@{{ Client.prac_email }}" readonly> </label>
                <br>

                 <button type="button" data-toggle="modal" data-target="#deletepersonnel" class="btn btn-danger btn-sm ">Delete Client</button>

                 <form role="form" method="POST" action="{{ url('/admin/deleteClient') }}">
                 <input type="hidden" name="id" class="form-control" value="@{{ Client.id }}" required>

                 @include('partials.deletePersonnel_modal')

            </div>

                 </div>
           </div>
             </div><!-- /.home -->



            <div id="reports" class="tab-pane fade">

            <div ng-controller="client_reportsController">
                    
                <div id = "thisClientReportsLoad" style = "width:100%; ">
                     
                @include('partials.loadinganimation')

                    <div id = "thisPractitionerReportsLoad_text" style="margin-left:45%;">
                         <small style="margin:auto;"  >
                            Fetching Client Reports....
                        </small>
                    </div>
                </div>

            <div ng-hide="Reports" id="emptymsg_reports" class="emptymsg_container" style="visibility:hidden;">
                <h2>No Reports found.</h2>
            </div>

            <div class="col-sm-10 col-md-10 col-lg-12" ng-cloak ng-show="Reports">

            <table ng-show="Reports" class="table table-bordered table-hover table-striped">
                    <br>

                    <input ng-show="Reports" type="text" placeholder="Search...." class="form-control"
                           ng-model="search.text">

                    <div class="row">
                        <div ng-show="Reports" class="checkbox" style="display: inline-block;">
                            <label style="font-size: 1em">
                                <input type="checkbox" value="" checked ng-model='search.type'
                                       ng-true-value="'In Progress'" ng-false-value=''>
                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                <small> In Progress </small> 
                            </label>
                        </div>

                        <div ng-show="Reports" class="checkbox" style="display: inline-block;">
                            <label style="font-size: 1em">
                                <input type="checkbox" value="" ng-model='search.type'
                                       ng-true-value="'Finished'" ng-false-value=''>
                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                 <small> Finished </small> 
                            </label>
                        </div>
                    </div>
                    <hr>

                    <tr ng-show="Reports">
                        <th>Report Number</th>
                        <th>Created on</th>
                        <th>Updated on</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>

                    <!-- List out reports -->
                    <tr ng-if="Reports" dir-paginate="report in Reports| filter:search.text | filter:search.type | itemsPerPage: 8"
                        pagination-id="allReportsPagination">
                        <td> @{{ report.id }} </td>
                        <td> @{{ report.created_at }} </td>
                        <td> @{{ report.updated_at }} </td>
                        <td> @{{ report.status }} </td>
                        <td style="width:10%"><a
                                    href="/practitioner/overview/@{{ report.id }}"
                                    class="btn btn-success btn-sm"> Edit</a></td>
                    </tr>

                </table>

                <dir-pagination-controls ng-if="Reports" template-url="/dirPagination.tpl.html"
                                         pagination-id="allReportsPagination"></dir-pagination-controls>

                 </div>
           </div>
             </div><!-- /.reports -->

           </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- -->
@endsection
@stop





