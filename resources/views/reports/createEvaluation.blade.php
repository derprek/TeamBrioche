@extends('master.practitioner')

@section('sidemenubar')

    @include('partials.sidebar_reports')
    
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
                        <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart"></i>Report Manager</a>
                    </li>

                    <li>
                         <a href="{{ URL::previous() }} "> <i class="fa fa-search"> </i> Report Overview</a>
                    </li>

                    <li class="active">
                        <i class="fa fa-pencil"></i> Create a new Evaluation report
                    </li>
                </ol>
            </div>
        </div>

        <div class="form-group">
            <div>
                <br>
                <a class="directionLinks pull-left" href="{{ url('reports/overview', $report->id) }}">
                  <i class="fa fa-chevron-left"></i> Back to Overview 
                </a>

                <a class="pull-right" data-toggle="popover" data-trigger="hover" data-html="true" data-animation="true"
                   data-placement="left" title="Report Information"
                   data-content="Report ID: {{ $report->id }} <br><hr>
                      Practitioner: {{ $practitioner->fname }} {{ $practitioner->sname }} <br>
                      Practitioner email: {{ $practitioner->email }}<br><hr>
                      Client: {{ $client->fname }} {{ $client->sname }}<br>
                      Client email: {{ $client->email }}">

                    <small style="color:#000;font-size:0.9em;">Information <i class="fa fa-info-circle"></i> </small>

                </a>
            </div>
        </div>
        <br>

        {!! Form::open(['url' => 'reports/evaluation/new']) !!}
        <input type="hidden" name="report_id" value= {{ $report->id }}>

        @include('partials.reports.create_report')

    </div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection

@stop