@extends('master.practitioner')

@section('sidemenubar')

    @include('partials.sidebar_reports')
    
@endsection

@section('content')

<script src="/js/Angular_JS/reports/MyReportsController.js"></script>
<script src="/js/Angular_JS/reports/sharedReportsController.js"></script>

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
                            <i class="fa fa-bar-chart-o"></i> Report Manager
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><strong>View my Reports</strong></a></li>
                    <li><a data-toggle="tab" href="#share">Shared with me </a></li>
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

                            <h3><a href="{{ url('reports/assessment/new') }}" role="button">Start one by clicking
                                    here.</a></h3>
                        </div>

                        <div ng-cloak>
                        <br>
                            <a ng-show="AllReports" id="addreport_btn" ng-cloak class="btn btn-success"
                               style="visibility:hidden;"
                               href="{{ url('reports/assessment/new') }}"
                               role="button"><i class="fa fa-file-o"></i> Create a new Report</a>
                            <br>

                            <table ng-show="AllReports" class="table table-bordered table-hover table-striped">
                                <br>

                                <input ng-show="AllReports" type="text" placeholder="Search...." class="form-control"
                                       ng-model="searchReports.text">

                                <div class="row">
                                    <div ng-show="AllReports" class="checkbox" style="display: inline-block;">
                                        <label style="font-size: 1em">
                                            <input type="checkbox" value="" checked ng-model='searchReports.type'
                                                   ng-true-value="'In Progress'" ng-false-value=''>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            <small> In Progress</small>
                                        </label>
                                    </div>

                                    <div ng-show="AllReports" class="checkbox" style="display: inline-block;">
                                        <label style="font-size: 1em">
                                            <input type="checkbox" value="" ng-model='searchReports.type'
                                                   ng-true-value="'Finished'" ng-false-value=''>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            <small> Finished</small>
                                        </label>
                                    </div>
                                </div>

                                <tr ng-show="(AllReports| filter:searchReports.text | filter:searchReports.type).length > 0">
                                    <th class="smallRow">Report Number @{{remaining()}}</th>
                                    <th class="normalRow">Client Name</th>
                                    <th class="mediumRow">Created on</th>
                                    <th class="mediumRow">Updated on</th>
                                    <th class="smallRow">Status</th>
                                    <th class="smallRow">Options</th>
                                </tr>

                                <!-- List out reports -->
                                <tr ng-if="AllReports"
                                    dir-paginate="report in AllReports| filter:searchReports.text | filter:searchReports.type | itemsPerPage: 8"
                                    pagination-id="allReportsPagination">
                                    <td> @{{ report.id }} </td>
                                    <td> @{{ report.name }} </td>
                                    <td> @{{ report.created_at }} </td>
                                    <td> @{{ report.updated_at }} </td>
                                    <td> @{{ report.status }} </td>
                                    <td>
                                        <a href="/reports/overview/@{{ report.id }}" class="btn btn-primary btn-sm">
                                            View</a>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div ng-if="AllReports">

                            <div ng-show="(AllReports| filter:searchReports.text | filter:searchReports.type).length == 0"
                                 class="emptyresults_container">
                                <h3> No results found <i class="fa fa-meh-o"></i></h3>
                            </div>

                        </div>

                        <dir-pagination-controls ng-if="AllReports" template-url="/dirPagination.tpl.html"
                                                 pagination-id="allReportsPagination"></dir-pagination-controls>


                    </div>
                    <!-- in home tab -->


                    <!-- share with me tab -->
                    <div ng-controller="SharedReportsController" id="share" class="tab-pane fade">

                        <div id="sharedReportsLoad" style="width:100%; ">

                            @include('partials.loadinganimation')

                            <div id="sharedReportsLoad_text" style="margin-left:45%;">
                                <small style="margin:auto;">
                                    Fetching your Reports....
                                </small>
                            </div>
                        </div>

                        <div id="emptymsg_shared" class="emptymsg_container" style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                        </div>

                        <div ng-cloak>
                            <table ng-show="SharedReports" class="table table-bordered table-hover table-striped">
                                <br>
                                <input ng-show="SharedReports" type="text" placeholder="Search...." class="form-control"
                                       ng-model="SearchShared.text">

                                <div class="row">
                                    <div ng-show="SharedReports" class="checkbox" style="display: inline-block;">
                                        <label style="font-size: 1em">
                                            <input type="checkbox" value="" checked ng-model='SearchShared.type'
                                                   ng-true-value="'In Progress'" ng-false-value=''>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            In Progress
                                        </label>
                                    </div>

                                    <div ng-show="SharedReports" class="checkbox" style="display: inline-block;">
                                        <label style="font-size: 1em">
                                            <input type="checkbox" value="" ng-model='SearchShared.type'
                                                   ng-true-value="'Finished'" ng-false-value=''>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            Finished
                                        </label>
                                    </div>
                                </div>

                                <tr ng-show="(SharedReports| filter:SearchShared.text | filter:SearchShared.type).length > 0">
                                    <th class="smallRow">Report Number</th>
                                    <th class="normalRow">Client Name</th>
                                    <th class="mediumRow">Created on</th>
                                    <th class="mediumRow">Updated on</th>
                                    <th class="smallRow">Status</th>
                                    <th class="smallRow">Options</th>
                                </tr>

                                <tr dir-paginate="report in SharedReports| filter:SearchShared.text | filter:SearchShared.type | itemsPerPage: 5"
                                    pagination-id="sharedReportsPagination">
                                    <td> @{{ report.id }} </td>
                                    <td> @{{ report.name }} </td>
                                    <td> @{{ report.created_at }} </td>
                                    <td> @{{ report.updated_at }} </td>
                                    <td> @{{ report.status }} </td>
                                    <td>
                                        <a href="/reports/overview/@{{ report.id }}"
                                           class="btn btn-info btn-sm">View</a>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div ng-if="SharedReports">

                            <div ng-show="(SharedReports| filter:SearchShared.text | filter:SearchShared.type).length == 0"
                                 class="emptyresults_container">
                                <h3> No results found <i class="fa fa-meh-o"></i></h3>
                            </div>

                        </div>

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








