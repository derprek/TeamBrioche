@extends('patientmaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="active">
                <a href="{{ url('client/reportarchives') }}"><i class="fa fa-bar-chart-o"></i> Reports</a>
            </li>
        </ul>
    </div>
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
                        <li>
                             <a href="{{ url('home') }}"><i class="fa fa-home"></i>Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> View all reports</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


                    <!-- report tab -->
                    <div id="reportApp"  ng-controller="MyReportsController">

                        <div id="allReportsLoad" style="width:100%; ">
                            
                            @include('partials.loadinganimation')

                            <div id="allReportsLoad_text" style="margin-left:45%;">
                                <small style="margin:auto;">
                                    Fetching your Reports....
                                </small>
                            </div>
                        </div>

                        <div id="emptymsg" ng-hide="AllReports" class="emptymsg_container" style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                        </div>

                        <div ng-cloak>

                            <table ng-show="AllReports" class="table table-bordered table-hover table-striped">
                                <br>

                                <input ng-show="AllReports" type="text" placeholder="Search...." class="form-control"
                                       ng-model="searchInbox.text">

                                <div class="row">
                                    <div ng-show="AllReports" class="checkbox" style="display: inline-block;">
                                        <label style="font-size: 1em">
                                            <input type="checkbox" value="" checked ng-model='searchInbox.type'
                                                   ng-true-value="'In Progress'" ng-false-value=''>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            <small> In Progress</small> 
                                        </label>
                                    </div>

                                    <div ng-show="AllReports" class="checkbox" style="display: inline-block;">
                                        <label style="font-size: 1em">
                                            <input type="checkbox" value="" ng-model='searchInbox.type'
                                                   ng-true-value="'Finished'" ng-false-value=''>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                             <small> Finished </small> 
                                        </label>
                                    </div>
                                </div>

                                <tr ng-show="(AllReports| filter:searchInbox.text | filter:searchInbox.type).length > 0">
                                    <th class="smallRow">Report Number</th>
                                    <th class="normalRow">Practitioner Name</th>
                                    <th class="mediumRow">Created on</th>
                                    <th class="mediumRow">Updated on</th>
                                    <th class="smallRow">Status</th>
                                    <th class="smallRow">Options</th>
                                </tr>

                                <!-- List out reports -->
                                <tr ng-if="AllReports" dir-paginate="report in AllReports| filter:searchInbox.text | filter:searchInbox.type | itemsPerPage: 8"
                                    pagination-id="allReportsPagination">
                                    <td> @{{ report.id }} </td>
                                    <td> @{{ report.name }} </td>
                                    <td> @{{ report.created_at }} </td>
                                    <td> @{{ report.updated_at }} </td>
                                    <td> @{{ report.status }} </td>
                                    <td>
                                      <a href="/reports/overview/@{{ report.id }}" class="btn btn-primary btn-sm"> View</a>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div ng-if="AllReports">

                            <div ng-show="(AllReports| filter:searchInbox.text | filter:searchInbox.type).length == 0" class="emptyresults_container">
                                 <h3> No results found <i class="fa fa-meh-o"></i> </h3>
                            </div>

                        </div>

                        <dir-pagination-controls ng-if="AllReports" template-url="/dirPagination.tpl.html"
                                                 pagination-id="allReportsPagination"></dir-pagination-controls>
<div style="display:none;">
<button id="addreport_btn"></button>
     </div>
                    </div>
                    <!-- /.report -->

            </div>
            <!-- /dynamic Table -->
        </div>

    </div>
@endsection
@stop