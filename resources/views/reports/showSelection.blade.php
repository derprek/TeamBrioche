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
                         <li>
                            <i></i> <a href="{{ url('practitioner/reportmanager') }}">Report Manager</a>
                        </li>
                         <li>
                            <i class="fa fa-dashboard"></i> <a href="{{ url('reports/selection/overview', $report->id) }}">Selection Overview</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pencil"></i> View Selection report
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12">

                <div class="form-group">

                <a class="btn btn-default" href="{{ url('/reports/selection/overview', $report->id) }}"> Back to
                    Overview </a>

                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#stakeholders" aria-expanded="false" aria-controls="collapseExample">
                     Stakeholders
                    </a>

                    <div class="collapse" id="stakeholders">
                      <div class="well">
                            <h4>Selection report ID: {{ $selection->id }}</h4>
                            <h4>Client: {{ $clientname }}</h4>
                            <h4>Practitioner-in-charge: {{ $pracname }}</h4>
                      </div>
                    </div>

                    {!! Form::open(['url' => 'reports/Selection/update']) !!}
                     <input type="hidden" name="reportid" value= {{ $report->id }}>
                     <input type="hidden" name="clientid" value= {{ $client_id }}>
                     <input type="hidden" name="selectid" value= {{ $selection->id }}>
                    <hr>
                    

                    @include('showform')

                        
                </div>
                <!-- /.form-group -->
    
             </div>
            <!-- /.col-12-content -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <br>


@endsection

@stop