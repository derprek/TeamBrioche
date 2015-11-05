@extends('master.practitioner')

@section('sidemenubar')

    @include('partials.sidebar_reports')
    
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

                    <li>
                         <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart"></i>Report Manager</a>
                    </li>

                    <li>
                         <a href="{{ url('/reports/overview', $report_id) }} "> <i class="fa fa-search"> </i>Report Overview</a>
                    </li>

                    <li class="active">
                        <i class="fa fa-pencil"></i> Create a new Typology
                    </li>
                    
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="form-group">
            <div>
                <br>
                <a class="directionLinks pull-left" href="{{ url('/reports/overview', $report_id) }}">
                    <i class="fa fa-chevron-left"></i> Back to Overview 
                </a>       

                <a class="pull-right" data-toggle="popover" data-html="true" data-trigger="click" data-animation="true" data-placement="left" title="Report Information" 
                  data-content="Report ID: {{ $report_id }} <br> <hr>
                  Practitioner: {{ $practitioner->fname }} {{ $practitioner->sname }} <br>
                  Practitioner email: {{ $practitioner->email }}<br><hr>
                  Client: {{ $client->fname }} {{ $client->sname }}<br>
                  Client email: {{ $client->email }}"> 

                    <small style="color:#111;font-size:0.9em;"><i  class="fa fa-info-circle"></i> Information </small>

                </a>
            </div>
        </div>

        <hr>
        {!! Form::open(['url' => 'reports/Typology']) !!}
        <input type="hidden" name="reportid" value= {{ $report_id }}>

        <div class="form-group">
            @include('create_report')
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- #page-wrapper -->

@stop