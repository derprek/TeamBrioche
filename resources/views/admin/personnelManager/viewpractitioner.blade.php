@extends('adminmaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="active">
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
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ url('admin/personnelmanager') }}"><i class="fa fa-users"></i> Personnel Manager</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-user"></i> View Practitioner
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Personal Information</a></li>
                    <li><a data-toggle="tab" href="#clients">Clients</a></li>
                    <li><a data-toggle="tab" href="#reports">Reports</a></li>
                </ul>

                <div class="tab-content">

                    <div id="home" class="tab-pane fade in active">

                        <div ng-controller="practitioner_informationController">

                            <div id="thisPractitionerInfoLoad" style="width:100%; ">

                                @include('partials.loadinganimation')

                                <div id="thisPractitionerLoad_text" style="margin-left:45%;">
                                    <small style="margin:auto;">
                                        Fetching Practitioner Information....
                                    </small>
                                </div>
                            </div>

                            <div ng-hide="Practitioner" id="emptymsg_information" class="emptymsg_container"
                                 style="visibility:hidden;">
                                <h2>No Practitioners found.</h2>
                                <a href="#" data-toggle="modal" data-target="#newclient"><h3> Click here to register
                                        your first Practitioners. </h3></a>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12" ng-cloak ng-show="Practitioner">
                                <form role="form" class="form-horizontal col-sm-12 col-md-10 col-lg-10" method="POST"
                                      action="{{ url('/admin/updatePractitioner') }}">

                                    <div class="form-group" ng-cloak>
                                        <BR>

                                        @if (Session::has('practitioner_updateerror'))
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your
                                                input.<br><br>
                                                <ul>
                                                    <li>The email has already been taken.</li>
                                                </ul>
                                            </div>
                                        @endif


                                        <input type="hidden" name="id" class="form-control"
                                               value="@{{ Practitioner.id }}" required>

                                        <div class="form-group">
                                            <label for="FirstName" class="col-sm-2 control-label">First Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="fname" class="form-control"
                                                       value="@{{ Practitioner.fname }}" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="LasttName" class="col-sm-2 control-label">Last Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="sname" class="form-control"
                                                       value="@{{ Practitioner.sname }}" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-4">
                                                <input type="email" name="email" class="form-control"
                                                       value="@{{ Practitioner.email }}"
                                                       required>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="submit" value="Update" class="btn btn-primary ">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <hr class="col-lg-12" style="border-top: solid 3px;">

                            <label for="Delete" class="col-sm-2 control-label" style="text-align:right;" >Delete</label>
                            <button data-toggle="modal" data-target="#deletepersonnel"
                                    class="btn btn-danger col-sm-2 col-md-2 col-lg-2">
                                Delete Practitioner
                            </button>

                            <form role="form" method="POST" action="{{ url('/admin/deletePractitioner') }}">
                                <input type="hidden" name="id" class="form-control" value="@{{ Practitioner.id }}"
                                       required>
                                @include('partials.deletePersonnel_modal')
                            </form>

                        </div>
                    </div>
                    <!-- /.home -->

                    <div id="clients" class="tab-pane fade">

                        <div ng-controller="practitioner_clientsController">

                            <div id="thisPractitionerClientsLoad" style="width:100%; ">

                                @include('partials.loadinganimation')

                                <div id="thisPractitionerClientsLoad_text" style="margin-left:45%;">
                                    <small style="margin:auto;">
                                        Fetching Practitioner Clients....
                                    </small>
                                </div>
                            </div>

                            <div ng-hide="Clients" id="emptymsg_clients" class="emptymsg_container"
                                 style="visibility:hidden;">
                                <h2>No Clients found.</h2>
                            </div>

                            <div class="col-sm-10 col-md-10 col-lg-12" ng-cloak ng-show="Clients">

                                <table ng-show="Clients" class="table table-bordered table-hover table-striped">
                                    <br>

                                    <input ng-show="Clients" type="text" placeholder="Search...." class="form-control"
                                           ng-model="searchclient.text">
                                    <hr>

                                    <tr ng-show="Clients">
                                        <th>Client ID</th>
                                        <th>Client Name</th>
                                        <th>Joined on</th>
                                        <th></th>
                                    </tr>

                                    <!-- List out reports -->
                                    <tr ng-if="Clients"
                                        dir-paginate="client in Clients| filter:searchclient.text | filter:search.type | itemsPerPage: 8"
                                        pagination-id="allClientsPagination">
                                        <td> @{{ client.id }} </td>
                                        <td> @{{ client.name }} </td>
                                        <td> @{{ client.created_at }} </td>
                                        <td style="width:10%"><a
                                                    href="/practitioner/overview/@{{ client.id }}"
                                                    class="btn btn-success btn-sm"> View</a></td>
                                    </tr>

                                </table>

                                <dir-pagination-controls ng-if="Clients" template-url="/dirPagination.tpl.html"
                                                         pagination-id="allClientsPagination"></dir-pagination-controls>

                            </div>
                        </div>
                    </div>
                    <!-- /.reports -->


                    <div id="reports" class="tab-pane fade">

                        <div ng-controller="practitioner_reportsController">

                            <div id="thisPractitionerReportsLoad" style="width:100%; ">

                                @include('partials.loadinganimation')

                                <div id="thisPractitionerReportsLoad_text" style="margin-left:45%;">
                                    <small style="margin:auto;">
                                        Fetching Practitioner Reports....
                                    </small>
                                </div>
                            </div>

                            <div ng-hide="Reports" id="emptymsg_reports" class="emptymsg_container"
                                 style="visibility:hidden;">
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

                                    <tr ng-show="Reports">
                                        <th>Report Number</th>
                                        <th>Client Name</th>
                                        <th>Created on</th>
                                        <th>Updated on</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>

                                    <!-- List out reports -->
                                    <tr ng-if="Reports"
                                        dir-paginate="report in Reports| filter:search.text | filter:search.type | itemsPerPage: 8"
                                        pagination-id="allReportsPagination">
                                        <td> @{{ report.id }} </td>
                                        <td> @{{ report.name }} </td>
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
                    </div>
                    <!-- /.reports -->

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- -->
@endsection
@stop






