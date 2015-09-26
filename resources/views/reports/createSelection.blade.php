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
            <li>
                <a href="{{ url('practitioner/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('practitioner/dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <i></i> <a href="{{ url('practitioner/reportmanager') }}">Report Manager</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pencil"></i> Create a new Selection report
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="form-group">
                <a class="btn btn-default" href="{{ URL::previous() }}"> Back to
                    Overview </a>

                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#stakeholders"
                   aria-expanded="false" aria-controls="collapseExample">
                    Stakeholders
                </a>

                <div class="collapse" id="stakeholders">
                    <div class="well">
                        <h4>Report No: {{ $report_id }}</h4>
                        <h4>Client: {{ $clientname }}</h4>
                        <h4>Practitioner-in-charge: {{ $pracname }}</h4>
                    </div>
                </div>

                {!! Form::open(['url' => 'reports/Selection']) !!}
                <input type="hidden" name="reportid" value= {{ $report_id }}>
                <input type="hidden" name="clientid" value= {{ $client_id }}>
                <hr>

                @include('create_report')
               
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <br>

   

@endsection

@stop