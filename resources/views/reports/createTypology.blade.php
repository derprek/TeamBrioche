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
<link href="/css/main.css" rel="stylesheet">
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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> Create a new Typology report
                        </li>

                    @else

                        <li>
                            <i class="fa fa-dashboard"></i> <a href="{{ url('practitioner/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> Create a new Typology report
                        </li>

                    @endif
                        
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <a class="btn btn-default" href="{{ url('/practitioner/overview', $report_id) }}"> Back to Overview </a>       

                {!! Form::open(['url' => 'reports/Typology']) !!}
                <input type="hidden" name="reportid" value= {{ $report_id }}>

                <div class="form-group">
                <hr>

                @include('create_report')
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->

@stop