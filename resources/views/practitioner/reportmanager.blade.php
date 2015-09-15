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

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <!-- 1st tab -->
                        <table class="table table-bordered table-hover table-striped">
                            @if($prac_reports->isEmpty())
                                <tr> No Records
                                </tr>

                            @else

                                <tr>
                                    <th>Report Number</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                <!-- List out reports -->
                                @foreach($prac_reports as $reportlist)
                                    <tr>
                                        <td> {{ $reportlist->id}}</td>
                                        <td> {{ App\User::find($reportlist->userid)->fname}}</td>
                                        <td> {{ $reportlist->created_at}}</td>
                                        <td> {{ $reportlist->updated_at}}</td>
                                        <td> {{ $reportlist->status}}</td>
                                        <td style="width:10%"><a
                                                    href="{{ url('/practitioner/overview', $reportlist->id) }}"
                                                    class="btn btn-success btn-sm form-control"> Edit</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>

                    <!-- in progress tab -->
                    <div id="menu1" class="tab-pane fade">
                        <table class="table table-bordered table-hover table-striped">
                            @if($progress->isEmpty())
                                <th> No Records
                                </th>
                            @else
                                <tr>
                                    <th>Report Number</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                @foreach($progress as $progresslist)
                                    <tr>
                                        <td> {{ $progresslist->id}} </td>
                                        <td> {{ App\User::find($progresslist->userid)->fname}}</td>
                                        <td> {{ $progresslist->created_at}}</td>
                                        <td> {{ $progresslist->updated_at}}</td>
                                        <td> {{ $progresslist->status}}</td>
                                        <td style="width:10%"><a
                                                    href="{{ url('/practitioner/overview', $progresslist->id) }}"
                                                    class="btn btn-success form-control"> Edit</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>

                    <!-- finished tab -->
                    <div id="menu2" class="tab-pane fade">
                        <table class="table table-bordered table-hover table-striped">

                            @if($finished->isEmpty())
                                <th> No Records
                                </th>
                            @else
                                <tr>
                                    <th>Report Number</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                @foreach($finished as $finishedlist)
                                    <tr>
                                        <td> {{ $finishedlist->id}} </td>
                                        <td> {{ App\User::find($finishedlist->userid)->fname}}</td>
                                        <td> {{ $finishedlist->created_at}}</td>
                                        <td> {{ $finishedlist->updated_at}}</td>
                                        <td> {{ $finishedlist->status}}</td>
                                        <td style="width:10%"><a
                                                    href="{{ url('/practitioner/overview', $finishedlist->id) }}"
                                                    class="btn btn-success form-control"> Edit</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>

                    <!-- share with me tab -->
                    <div id="menu3" class="tab-pane fade">
                        <table class="table table-bordered table-hover table-striped">

                            @if($shared->isEmpty())
                                <th> No Records
                                </th>
                            @else

                                <tr>
                                    <th>Report Number</th>
                                    <th>Client Name</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>

                                @foreach($shared as $sharedlist)
                                    <tr>
                                        <td> {{ $sharedlist->id}} </td>
                                        <td> {{ App\User::find($sharedlist->userid)->fname}}</td>
                                        <td> {{ $sharedlist->created_at}}</td>
                                        <td> {{ $sharedlist->updated_at}}</td>
                                        <td> {{ $sharedlist->status}}</td>
                                        <td style="width:10%"><a
                                                    href="{{ url('/practitioner/overview', $sharedlist->id) }}"
                                                    class="btn btn-success form-control"> Edit</a></td>
                                    </tr>
                                @endforeach
                            @endif
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








