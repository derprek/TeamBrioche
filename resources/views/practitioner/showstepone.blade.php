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
                            <i class="fa fa-bar-chart"></i> View Report
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <h2>Report: {{$report->id}}</h2>
            <input type="hidden" name="reportid" value={{$report->id}}>

            <!-- Display client and practitioner name -->
            <div>
                <a class="btn btn-default" href="{{ url('/practitioner/overview', $report->id) }}"> Back to
                    Overview </a>

                <p style="float:right"> Client's name: {{ $clientinfo->fname}} {{ $clientinfo->sname}} </p>
                <br>
                <br>

                <p style="float:right"> Practitioner's name: {{ $pracinfo->name }} </p>
                <br>
            </div>


            <div class="dashboardbody">
                <hr>
                @foreach($answerlist as $reportinfo)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">

                            <thead>
                            <tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Display answers in the report -->
                            @foreach($reportinfo as $reportlist)
                                <tr>
                                    <td style="width:25%">{{ $reportlist->question }} </td>
                                    <td style="width:65%">{{ $reportlist->pivot->answers}} </td>
                                    <td style="width:10%">
                                        <button type="button" id="regbtn" class="btn btn-default form-control"
                                                data-toggle="modal"
                                                data-target=<?php echo "#update" . $reportlist->pivot->rqid;?>>Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    <hr/>
                @endforeach
                <hr/>
            </div>
            <!-- /.dashboardbody -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @foreach($answerlist as $reportinfo)

        @foreach($reportinfo as $reportlist)
            <input type="hidden" name="reportid" value={{$report->id}}>
            <div class="container">
                <!-- Modal -->
                <div class="modal fade" role="dialog" id=<?php echo "update" . $reportlist->pivot->rqid ?> >
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><span style="color:#000000">Update Report</span></h4>
                            </div>

                            <div class="modal-body">
                                <form role="form" method="POST" action="{{ url('reports/stepone/update') }}">

                                    <div class="form-group" id="qntable">
                                        <input type='hidden' name='rqid' value= {{ $reportlist->pivot->rqid }}>
                                        <input type="hidden" name="reportid" value={{$report->id}}>
                                        <label for="fname"> {{ $reportlist->question}}</label>
                                        <textarea class="form-control" name="answersid[{{ $reportlist->pivot->rqid }}]"
                                                  rows="5">{{ $reportlist->pivot->answers}}</textarea>
                                        <br>
                                    </div>

                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-success form-control">Update</button>
                                        <hr/>
                                        <button type="button" class="btn btn-danger form-control" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                    <!-- /.modal-footer -->
                                </form>
                            </div>
                            <!-- modal-body -->
                        </div>
                        <!-- modal-content -->
                    </div>
                    <!-- modal-dialog -->
                </div>
                <!-- modal -->
                @endforeach
            </div>
            <!-- container -->
        @endforeach

@endsection
@stop
