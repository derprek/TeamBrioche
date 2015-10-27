@extends('patientmaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-home"></i> Dashboard</a>
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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('home') }}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> Report Manager</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            @unless(empty($report->id))
                    <!-- Dynamic Table -->
            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">View all Reports</a></li>
                    <li><a data-toggle="tab" href="#report">Latest Report</a></li>
                </ul>
                @endunless

                <div class="tab-content">
                    <!-- home tab  -->

                    <div id="home" class="tab-pane fade in active">
                            
                        @if(empty($latestreport))

                             <div id="emptymsg" class="emptymsg_container">
                                <h2>No Reports found.</h2>
                            </div>

                        @else
                            <h2>Report History</h2>
                            <hr>
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <th>Report Number</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Updated on</th>
                                    <th>Edit</th>
                                </tr>

                                @if(empty($reporthistory[0]))

                                    <tr>
                                        <td> No Records</td>
                                    </tr>

                                @else

                                    @foreach($reporthistory as $report)

                                        <tr>
                                            <td> {{ $report->id}}</td>
                                            <td> {{ $report->status }}  </td>
                                            <td> {{ $report->created_at }}  </td>
                                            <td> {{ $report->updated_at }}  </td>
                                            <td style="width:10%"><a
                                                href="/client/overview/{{ $report->id }}"
                                                class="btn btn-success btn-sm form-control"> View</a></td>
                                        </tr>

                                    @endforeach
                                @endif

                            </table>

                        @endif

                    </div>  
                    <!-- /#home -->

                    <!-- report tab -->
                    <div id="report" class="tab-pane fade">

                         @if(empty($latestreport))
                            <h3> No Reports found in our system. </h3>
                            @else
                                <br>
                                <h4>
                                    <span style="color:#000000">Report Overview: {{ $report->id}}</span>
                                </h4>
                            @include('partials.show_overview')

                        @endif
                    
                    </div>
                    <!-- /.report -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /dynamic Table -->
        </div>

    </div>
@endsection
@stop