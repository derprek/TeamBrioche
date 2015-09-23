@extends('practitionermaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
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
@endsection

@section('content')
@include('reports_angularjs')

<link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.7.1/loading-bar.min.css' type='text/css' media='all' />
 <script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.7.1/loading-bar.min.js'></script>

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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('practitioner/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart"></i> Report Manager
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

               

                <div ng-app="reportApp" class="tab-content">
                    <div ng-controller="MyReportsController" id="home" class="tab-pane fade in active">
                        
                         <div id = "allReportsLoad" style = "width:100%; ">
                            <br><br><br>
                                <div style="margin:auto;"  class="la-ball-spin-clockwise-fade-rotating la-dark la-2x">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            <br>
                            <div id = "allReportsLoad_text" style="margin-left:45%;">
                                 <small style="margin:auto;"  >
                                    Fetching your Reports....
                                </small>
                            </div>
                             </div>

                        <div id="emptymsg" style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                        </div>

                        <table ng-show="AllReports" class="table table-bordered table-hover table-striped">
                        <br>
                           
                            <input ng-show="AllReports" type ="text" placeholder ="Search...." class = "form-control" ng-model="search.text">

                            <div class ="row">
                            <div ng-show="AllReports" class="checkbox" style = "display: inline-block;">
                                <label style="font-size: 1em">
                                    <input type="checkbox" value="" checked ng-model='search.type' ng-true-value="'In Progress'" ng-false-value=''>
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                    In Progress
                                </label>
                            </div>

                            <div ng-show="AllReports" class="checkbox" style = "display: inline-block;">
                                <label style="font-size: 1em">
                                    <input type="checkbox" value="" ng-model='search.type' ng-true-value="'Finished'" ng-false-value=''>
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                    Finished
                                </label>
                            </div>
                            </div>
                            <hr>
                                
                                <tr ng-show="AllReports">
                                    <th>Report Number @{{remaining()}}</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                <!-- List out reports -->
                                    <tr dir-paginate="report in AllReports| filter:search.text | filter:search.type | itemsPerPage: 8" pagination-id="allReportsPagination">
                                        <td> @{{ report.id }} </td>
                                        <td> @{{ report.name }} </td>
                                        <td> @{{ report.created_at }} </td>
                                        <td> @{{ report.updated_at }} </td>
                                        <td> @{{ report.status }} </td>
                                        <td style="width:10%"><a
                                                    href="/practitioner/overview/@{{ report.id }}"
                                                    class="btn btn-success btn-sm form-control"> Edit</a></td>
                                    </tr>      
                            
                        </table>

                        <dir-pagination-controls template-url="/dirPagination.tpl.html" pagination-id="allReportsPagination"> </dir-pagination-controls>
                       
                    
                    </div> 
                    <!-- in home tab -->



                    <!-- share with me tab -->
                    <div ng-controller="SharedReportsController" id="menu1" class="tab-pane fade">

                     <div id = "sharedReportsLoad" style = "width:100%; ">
                            <br><br><br>
                                <div style="margin:auto;"  class="la-ball-spin-clockwise-fade-rotating la-dark la-2x">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            <br>
                            <div id = "sharedReportsLoad_text" style="margin-left:45%;">
                                 <small style="margin:auto;"  >
                                    Fetching your Reports....
                                </small>
                            </div>
                             </div>

                             <div id="shared_emptymsg" style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                        </div>

                        <table ng-show="SharedReports" class="table table-bordered table-hover table-striped">
                            <br>
                             <input ng-show="SharedReports" type ="text" placeholder ="Search...." class = "form-control" ng-model="search.text">

                            <div class ="row">
                            <div ng-show="SharedReports" class="checkbox" style = "display: inline-block;">
                                <label style="font-size: 1em">
                                    <input type="checkbox" value="" checked ng-model='search.type' ng-true-value="'In Progress'" ng-false-value=''>
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                    In Progress
                                </label>
                            </div>

                            <div ng-show="SharedReports" class="checkbox" style = "display: inline-block;">
                                <label style="font-size: 1em">
                                    <input type="checkbox" value="" ng-model='search.type' ng-true-value="'Finished'" ng-false-value=''>
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                    Finished
                                </label>
                            </div>
                            </div>
                            <hr>

                                <tr ng-show="SharedReports">
                                    <th>Report Number</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                <tr dir-paginate="report in SharedReports| filter:search.text | filter:search.type | itemsPerPage: 5" pagination-id="sharedReportsPagination">
                                    <td> @{{ report.id }} </td>
                                    <td> @{{ report.name }} </td>
                                    <td> @{{ report.created_at }} </td>
                                    <td> @{{ report.updated_at }} </td>
                                    <td> @{{ report.status }} </td>
                                    <td style="width:10%"><a
                                    href="/practitioner/overview/@{{ report.id }}"
                                    class="btn btn-success btn-sm form-control"> Edit</a></td>
                                </tr>
                                
                        </table>

                        <dir-pagination-controls template-url="/dirPagination.tpl.html" pagination-id="sharedReportsPagination"> </dir-pagination-controls>

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








