@extends('practitionermaster')

@section('sidemenubar')
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
                        
                    @if(Session::has('is_admin'))

                        <li>
                            <i class="fa fa-bar-chart"></i> <a href="{{ url('admin/reportmanager') }}">Report
                                Manager</a>
                        </li>
                        <li>
                            <i class="fa fa-search"></i>
                            <a href="{{ url('/practitioner/overview', $report->id) }} ">Report
                                Overview</a>
                        </li>
                        <li>
                            Edit Assessment
                        </li>

                    @else

                       <li>
                            <i class="fa fa-bar-chart"></i> <a href="{{ url('practitioner/reportmanager') }}">Report
                                Manager</a>
                        </li>
                        <li>
                            <i class="fa fa-search"></i>
                            <a href="{{ url('/practitioner/overview', $report->id) }} ">Report
                                Overview</a>
                        </li>
                        <li>
                            Edit Assessment
                        </li>

                    @endif
                    </ol>
                </div>
            </div>
            <!-- /.row -->

                <div class="form-group">
                    {!! Form::open(['url' => 'reports/stepAssessment/update']) !!}

                    <h3>Edit Assessment</h3>
                    <hr>
                    <input type="hidden" name="reportid" value={{$report->id}}>

                    <!-- Display client and practitioner name -->
                    <div>
                        <a class="btn btn-default" href="{{ url('/practitioner/overview', $report->id) }}"> Back to
                            Overview </a>

                        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#stakeholders"
                           aria-expanded="false" aria-controls="collapseExample">
                            Stakeholders
                        </a>

                        <div class="collapse" id="stakeholders">
                            <div class="well">
                                <h4>Report: {{$report->id}}</h4>
                                <h4>Client's name: {{ $clientinfo->fname}} {{ $clientinfo->sname}}</h4>
                                <h4>Practitioner's name: {{ $pracname }}</h4>
                            </div>
                        </div>


                    </div>
                </div>

                    <hr>

                  @include('show_report')

            <!-- /.form-group -->
        </div>
        <!-- /.container-fluid -->
    </div>

@endsection
@stop
