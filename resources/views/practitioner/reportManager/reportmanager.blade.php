@extends('practitionermaster')

@section('sidemenubar')
    @if(Session::has('is_admin'))
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li >
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
    
    @else
    
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
            </ul>
        </div>

    @endif
@endsection

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i>  Report Manager
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><strong>View my Reports</strong></a></li>
                    <li><a data-toggle="tab" href="#menu1">Shared with me </a></li>
                </ul>


                <div id="reportApp" class="tab-content">
                    <div ng-controller="MyReportsController" id="home" class="tab-pane fade in active">

                        <div id="allReportsLoad" style="width:100%; ">
                            
                            @include('partials.loadinganimation')

                            <div id="allReportsLoad_text" style="margin-left:45%;">
                                <small style="margin:auto;">
                                    Fetching your Reports....
                                </small>
                            </div>
                        </div>

                        <div id="emptymsg" class="emptymsg_container" style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                        </div>

                        <table ng-show="AllReports" class="table table-bordered table-hover table-striped">
                            <br>

                            <input ng-show="AllReports" type="text" placeholder="Search...." class="form-control"
                                   ng-model="search.text">

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

                            <tr ng-show="AllReports">
                                <th>Report Number @{{remaining()}}</th>
                                <th>Client Name</th>
                                <th>Created on</th>
                                <th>Updated on</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>

                            <!-- List out reports -->
                            <tr ng-if="AllReports" dir-paginate="report in AllReports| filter:search.text | filter:search.type | itemsPerPage: 8"
                                pagination-id="allReportsPagination">
                                <td> @{{ report.id }} </td>
                                <td> @{{ report.name }} </td>
                                <td> @{{ report.created_at }} </td>
                                <td> @{{ report.updated_at }} </td>
                                <td> @{{ report.status }} </td>
                                <td style="width:10%"><a
                                            href="/reports/overview/@{{ report.id }}"
                                            class="btn btn-success btn-sm"> Edit</a></td>
                            </tr>

                        </table>

                        <dir-pagination-controls ng-if="AllReports" template-url="/dirPagination.tpl.html"
                                                 pagination-id="allReportsPagination"></dir-pagination-controls>


                    </div>
                    <!-- in home tab -->


                    <!-- share with me tab -->
                    <div ng-controller="SharedReportsController" id="menu1" class="tab-pane fade">

                        <div id="sharedReportsLoad" style="width:100%; ">
                            
                            @include('partials.loadinganimation')

                            <div id="sharedReportsLoad_text" style="margin-left:45%;">
                                <small style="margin:auto;">
                                    Fetching your Reports....
                                </small>
                            </div>
                        </div>

                        <div id="shared_emptymsg" class="emptymsg_container" style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                        </div>

                        <table ng-cloak ng-show="SharedReports" class="table table-bordered table-hover table-striped">
                            <br>
                            <input ng-show="SharedReports" type="text" placeholder="Search...." class="freportorm-control"
                                   ng-model="search.text">

                            <div class="row">
                                <div ng-show="SharedReports" class="checkbox" style="display: inline-block;">
                                    <label style="font-size: 1em">
                                        <input type="checkbox" value="" checked ng-model='search.type'
                                               ng-true-value="'In Progress'" ng-false-value=''>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        In Progress
                                    </label>
                                </div>

                            <div ng-cloak ng-show="SharedReports" class="checkbox" style = "display: inline-block;">
                                <label style="font-size: 1em">
                                    <input type="checkbox" value="" ng-model='search.type' ng-true-value="'Finished'" ng-false-value=''>
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                    Finished
                                </label>
                            </div>
                            </div>

                                <tr ng-cloak ng-show="SharedReports">
                                    <th>Report Number</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                <tr ng-cloak dir-paginate="report in SharedReports| filter:search.text | filter:search.type | itemsPerPage: 5" pagination-id="sharedReportsPagination">
                                    <td> @{{ report.id }} </td>
                                    <td> @{{ report.name }} </td>
                                    <td> @{{ report.created_at }} </td>
                                    <td> @{{ report.updated_at }} </td>
                                    <td> @{{ report.status }} </td>
                                    <td style="width:10%"><a
                                    href="/reports/overview/@{{ report.id }}"
                                    class="btn btn-success btn-sm form-control"> Edit</a></td>
                                </tr>
                                
                        </table>

                        <dir-pagination-controls ng-if="SharedReports" template-url="/dirPagination.tpl.html"
                                                 pagination-id="sharedReportsPagination"></dir-pagination-controls>

                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
@endsection
@stop








