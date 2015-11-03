@extends('master.practitioner')

@section('sidemenubar')

    @include('partials.sidebar_personnel_client')

@endsection

@section('content')

    @if(Session::has('successful_registration'))
        <script>
            BootstrapDialog.show({
                title: 'Success',
                message: '{{ Session::pull('successful_registration')}} <strong>{{ Session::pull('email')}}.</strong> <br><br> <strong>The default password is: {{ Session::pull('defaultpassword')}}</strong>',
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

    <div>
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
                                <a href="{{ url('admin/personnelmanager') }}"> <i class="fa fa-users"></i> Personnel
                                    Manager </a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i> View Client
                            </li>
                        </ol>
                    @else
                        <ol class="breadcrumb">
                            <li>
                                <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client
                                    Manager</a>
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

                            <div id="thisClientInfoLoad" style="width:100%; ">

                                @include('partials.loadinganimation')

                                <div id="thisClientInfoLoad_text" style="margin-left:45%;">
                                    <small style="margin:auto;">
                                        Fetching Client Information....
                                    </small>
                                </div>
                            </div>

                            <div class="col-sm-10 col-md-10 col-lg-12" ng-cloak ng-show="Client">
                                <form role="form" class="form-horizontal col-sm-12 col-md-10 col-lg-10" method="POST"
                                      action="{{ url('/practitioner/updateClient') }}">
                                    <br>

                                    <div class="form-group" ng-cloak>

                                        @if (Session::has('client_updateerror'))
                                            {{Session::forget('client_updateerror')}}
                                            <br>
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your
                                                input.<br><br>
                                                <ul>
                                                    <li>The email has already been taken.</li>
                                                </ul>
                                            </div>
                                        @endif


                                        <input type="hidden" name="id" class="form-control" value="@{{ Client.id }}"
                                               required>


                                        <div class="form-group">
                                            <label for="FirstName" class="col-sm-2 control-label">First Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="fname" class="form-control"
                                                       value="@{{ Client.fname }}" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="LasttName" class="col-sm-2 control-label">Last Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="sname" class="form-control"
                                                       value="@{{ Client.sname }}" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-4">
                                                <input type="email" name="email" class="form-control"
                                                       value="@{{ Client.email }}"
                                                       required>
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <input type="submit" value="Update" class="btn btn-primary ">
                                            </div>
                                        </div>

                                </form>

                            <br>
                                <h4> Under the supervision of: </h4>
                                <hr>
                                <div class="form-group">
                                    <label for="PracName" class="col-sm-2 control-label">Practitioner Name:</label>

                                    <div class="col-sm-4">
                                        <input type="text" name="prac_name" class="form-control"
                                               value="@{{ Client.prac_name }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="PracEmail" class="col-sm-2 control-label">Email Address:</label>

                                    <div class="col-sm-4">
                                        <input type="text" name="prac_email" class="form-control"
                                               value="@{{ Client.prac_email }}" readonly>
                                    </div>


                                    <form role="form" method="POST" action="{{ url('/deleteClient') }}">
                                        <input type="hidden" name="id" class="form-control" value="@{{ Client.id }}"
                                               required>
                                        <button type="button" data-toggle="modal" data-target="#deletepersonnel"
                                                class="btn btn-danger  col-sm-2 col-md-2 col-lg-2">Delete Client
                                        </button>

                                        @include('partials.deletePersonnel_modal')
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.home -->


                <div id="reports" class="tab-pane fade">

                    <div ng-controller="client_reportsController">

                        <div id="thisClientReportsLoad" style="width:100%; ">

                            @include('partials.loadinganimation')

                            <div id="thisPractitionerReportsLoad_text" style="margin-left:45%;">
                                <small style="margin:auto;">
                                    Fetching Client Reports....
                                </small>
                            </div>
                        </div>

                        <div ng-hide="Reports" id="emptymsg_reports" class="emptymsg_container"
                             style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                            @unless(Session::has('is_admin'))
                                <h3><a href="{{ url('reports/assessment/new') }}" role="button">Start one by clicking
                                        here.</a></h3>
                            @endunless
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
                                            <small> In Progress</small>
                                        </label>
                                    </div>

                                    <div ng-show="Reports" class="checkbox" style="display: inline-block;">
                                        <label style="font-size: 1em">
                                            <input type="checkbox" value="" ng-model='search.type'
                                                   ng-true-value="'Finished'" ng-false-value=''>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            <small> Finished</small>
                                        </label>
                                    </div>
                                </div>
                                <hr>

                                <tr ng-show="(Reports| filter:search.text | filter:search.type).length > 0">
                                    <th class="smallRow">Report Number</th>
                                    <th class="mediumRow">Created on</th>
                                    <th class="mediumRow">Updated on</th>
                                    <th class="mediumRow">Status</th>
                                    <th class="smallRow">View</th>
                                </tr>

                                <!-- List out reports -->
                                <tr ng-if="Reports"
                                    dir-paginate="report in Reports| filter:search.text | filter:search.type | itemsPerPage: 8"
                                    pagination-id="allReportsPagination">
                                    <td> @{{ report.id }} </td>
                                    <td> @{{ report.created_at }} </td>
                                    <td> @{{ report.updated_at }} </td>
                                    <td> @{{ report.status }} </td>
                                    <td style="width:10%"><a
                                                href="/reports/overview/@{{ report.id }}"
                                                class="btn btn-success btn-sm"> View</a></td>
                                </tr>

                            </table>

                            <div ng-if="Reports">

                                <div ng-show="(Reports| filter:search.text | filter:search.type).length == 0"
                                     class="emptyresults_container">
                                    <h3> No results found <i class="fa fa-meh-o"></i></h3>
                                </div>

                            </div>

                            <dir-pagination-controls ng-if="Reports" template-url="/dirPagination.tpl.html"
                                                     pagination-id="allReportsPagination"></dir-pagination-controls>

                        </div>
                    </div>
                </div>
                <!-- /.reports -->

            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- -->
@endsection
@stop






