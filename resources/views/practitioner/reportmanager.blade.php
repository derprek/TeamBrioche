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
                    <li class="active"><a data-toggle="tab" href="#home"><strong>View all Reports</strong></a></li>
                    <li><a data-toggle="tab" href="#menu1">In Progress</a></li>
                    <li><a data-toggle="tab" href="#menu2">Finished </a></li>
                    <li><a data-toggle="tab" href="#menu3">Shared with me </a></li>

                </ul>

               

                <div ng-app="reportApp" class="tab-content">
                    <div ng-controller="ReportsController" id="home" class="tab-pane fade in active">
                        
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
                           
                                <input ng-show="AllReports" type ="text" placeholder ="Search...." class = "form-control" ng-model="search">
                                <br>
                                <tr ng-show="AllReports">
                                    <th>Report Number @{{remaining()}}</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                <!-- List out reports -->
                                
                                    <tr ng-repeat="report in AllReports| filter:search">
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
                    
                    </div> 
                    <!-- in home tab -->

                    <!-- in progress tab -->
                    <div id="menu1" ng-controller="ProgressReportsController" class="tab-pane fade">

                         <div id = "progressReportsLoad" style = "width:100%; ">
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
                            <div id = "progressReportsLoad_text" style="margin-left:45%;">
                                 <small style="margin:auto;"  >
                                    Fetching your Reports....
                                </small>
                            </div>
                             </div>

                             <div id="progress_emptymsg" style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                        </div>

                        <table ng-show="ProgressReports" class="table table-bordered table-hover table-striped">
                            <br>
                             <input ng-show="ProgressReports" type ="text" placeholder ="Search...." class = "form-control" ng-model="search">
                             <br>
                                <tr ng-show="ProgressReports">
                                    <th>Report Number </th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                               
                                    <tr ng-repeat="report in ProgressReports| filter:search">
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
                    </div>

                    <!-- finished tab -->
                    <div ng-controller="ProgressFinishedController" id="menu2" class="tab-pane fade">

                        <div id = "finishedReportsLoad" style = "width:100%; ">
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
                            <div id = "finishedReportsLoad_text" style="margin-left:45%;">
                                 <small style="margin:auto;"  >
                                    Fetching your Reports....
                                </small>
                            </div>
                             </div>

                             <div id="finished_emptymsg" style="visibility:hidden;">
                            <h2>No Reports found.</h2>
                        </div>

                        <table ng-show="FinishedReports" class="table table-bordered table-hover table-striped">

                            <br>
                             <input ng-show="FinishedReports" type ="text" placeholder ="Search...." class = "form-control" ng-model="search">
                             <br>
                                <tr ng-show="FinishedReports">
                                    <th>Report Number</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                               <tr ng-repeat="report in FinishedReports| filter:search">
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
                    </div>

                    <!-- share with me tab -->
                    <div ng-controller="SharedReportsController" id="menu3" class="tab-pane fade">

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
                             <input ng-show="SharedReports" type ="text" placeholder ="Search...." class = "form-control" ng-model="search">
                             <br>

                                <tr ng-show="SharedReports">
                                    <th>Report Number</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                <tr ng-repeat="report in SharedReports| filter:search">
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








