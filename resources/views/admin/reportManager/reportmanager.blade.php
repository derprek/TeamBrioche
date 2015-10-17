@extends('adminmaster')

@section('sidemenubar')

    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li>
                <a href="{{ url('admin/personnelmanager') }}"><i class="fa fa-users"></i> Personnel Manager</a>
            </li>
            <li class="active">
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
            <div id="reportApp">
            <div ng-controller="adminReportManagerController" class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-sm-10 col-md-10 col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-users"></i> Report Manager
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

             <div id = "allReportsLoad" style = "width:100%; ">
                     
                @include('partials.loadinganimation')

                    <div id = "allReportsLoad_text" style="margin-left:45%;">
                         <small style="margin:auto;"  >
                            Fetching all Reports....
                        </small>
                    </div>
            </div>

            <div ng-hide="AllReports" id="emptymsg" class="emptymsg_container" style="visibility:hidden;">
                <h2>No Reports found.</h2>
            </div>

            <div class="col-sm-10 col-md-10 col-lg-12">
            <br>

            <!-- Client list table -->
            <table ng-show="AllReports" class="table table-bordered table-hover table-striped">

                <input ng-show="AllReports" type="text" placeholder="Search...." class="form-control" ng-model="search.text">
                 <div class="row">
                    <div ng-show="AllReports" class="checkbox" style="display: inline-block;">
                        <label style="font-size: 1em">
                            <input type="checkbox" value="" checked ng-model='search.type'
                                   ng-true-value="'In Progress'" ng-false-value=''>
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                            <small> In Progress </small> 
                        </label>
                    </div>

                    <div ng-show="AllReports" class="checkbox" style="display: inline-block;">
                        <label style="font-size: 1em">
                            <input type="checkbox" value="" ng-model='search.type'
                                   ng-true-value="'Finished'" ng-false-value=''>
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                             <small> Finished </small> 
                        </label>
                    </div>
                </div>

                <br>

                <tr ng-show="AllReports">
                    <th>Report ID</th>
                    <th>Client</th>
                    <th>Supervised by</th>
                    <th>Created on</th>
                    <th>Last Update</th>
                    <th>View</th>
                </tr>

                <tr dir-paginate="report in AllReports| filter:search.text | filter:search.type | itemsPerPage: 8" pagination-id="ReportManagerPagination">
                    <td> @{{ report.id }}</td>
                    <td> @{{ report.client_name }}</td>
                    <td> @{{ report.prac_name }}</td>
                    <td> @{{ report.status }}</td>
                    <td> @{{ report.updated_at }}</td>
                    <td>
                        <a href="/practitioner/overview/@{{ report.id }}"
                           class="btn btn-success btn-sm"> View </a>
                    </td>
                </tr>

            </table>

              <dir-pagination-controls ng-if="AllReports" template-url="/dirPagination.tpl.html"
                                                 pagination-id="ReportManagerPagination"></dir-pagination-controls>

            <!-- /.table -->
            </div>
            <!-- /.prac div -->
     
            <!-- /.client div -->

            </div>
            </div>
           
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
@endsection
@stop






