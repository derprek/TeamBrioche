@extends('patientmaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">
            <a href="{{ url('reportarchives') }}"><i class="fa fa-bar-chart-o"></i> Reports</a>
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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('home') }}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> Report Manager</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            @unless(empty($reports->id))
                    <!-- Dynamic Table -->
            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Latest Report</a></li>
                    <li><a data-toggle="tab" href="#menu1">View all Reports</a></li>
                </ul>
                @endunless

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <!-- Main jumbotron for a primary marketing message or call to action -->
                        <h3> Report Number: {{ $latestreport->id }} </h3>
                        <div class="body" style="float:right"> <h4>Status: {{ $latestreport-> status }} </h4></div>
                        <br>
                        <hr/>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
                                </tr>
                                </thead>
                                @if(empty($qrarraylength))
                                    <tr>
                                        <td> Create a new Report</td>
                                    </tr>
                                @else
                                    <tbody>

                                    @for ($i = 0; $i < $qrarraylength; $i++)
                                        <tr>
                                            <td>{{ $questionlist[$i]->question }} </td>
                                            <td>{{ $answerlist[$i]}} </td>
                                        </tr>
                                    @endfor

                                    </tbody>
                                @endif
                            </table>
                        </div>

                        <label for="pracnotes">Practitioner's Notes</label>
                        @if (!empty($latestreport->prac_notes))
                            <textarea name='pracnotes' class="form-control" rows="7"
                                      readonly=""> {{ $latestreport->prac_notes }}</textarea>
                        @else
                            <textarea name='pracnotes' class="form-control" rows="7" readonly=""> No Remarks.</textarea>
                        @endif
                    </div>
                    <!-- /.container-fluid -->

                    <div id="menu1" class="tab-pane fade">  <!-- Second tab -->

                        <h2>Report History</h2>
                        <hr>
                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>Report Number</th>
                                <th>Status</th>
                                <th>Created on</th>
                                <th>Updated on</th>
                            </tr>

                            @if(empty($reporthistory[0]))

                                <tr>
                                    <td> No Records</td>
                                </tr>

                            @else

                                @foreach($reporthistory as $report)

                                    <tr>
                                        <td><a href="{{ url('/reports', $report->id) }}"> {{ $report->id}}</a></td>
                                        <td> {{ $report->status }}  </td>
                                        <td> {{ $report->created_at }}  </td>
                                        <td> {{ $report->updated_at }}  </td>
                                    </tr>

                                @endforeach
                            @endif

                        </table>


                    </div>

                </div>
            </div>
        </div>

        <!-- /dynamic Table -->
    </div>
@endsection
@stop