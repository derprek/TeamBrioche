@extends('practitionermaster')


@section('sidemenubar')
    
    @if(Session::has('is_admin'))
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li >
                    <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="{{ url('admin/personnelmanager') }}"><i class="fa fa-users"></i> Personnel Manager</a>
                </li>
                <li class="active">
                    <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
                </li>
                <li>
                    <a href="{{ url('admin/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
                </li>
            </ul>
        </div>
    
    @else
    
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

    @endif

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
                            <a href="{{ url('/reports/overview', $report->id) }} ">Report
                                Overview</a>
                        </li>
                        <li>
                            <a href="{{ url('/reports/evaluation/overview', $report->id) }}">
                            Evaluation Manager </a>
                        </li>
                        <li>
                            Viewing <strong> Evaluation: {{ $evaluation->id }}</strong> for Report: {{$report->id}}.
                        </li>

                    @else

                       <li>
                            <i class="fa fa-bar-chart"></i> <a href="{{ url('practitioner/reportmanager') }}">Report
                                Manager</a>
                        </li>
                        <li>
                            <i class="fa fa-search"></i>
                            <a href="{{ url('/reports/overview', $report->id) }} ">Report
                                Overview</a>
                        </li>
                        <li>
                            <a href="{{ url('/reports/evaluation/overview', $report->id) }}">
                            Evaluation Manager </a>
                        </li>
                        <li >
                            Viewing <strong> Evaluation: {{ $evaluation->id }}</strong> for Report: {{$report->id}}.
                        </li>

                    @endif
                        
                    </ol>
                </div>
            </div>
            <!-- /.row -->

                <div class="form-group">

                    <div>

                        <br>
                        <a class="pull-left" href="{{ url('/reports/evaluation/overview', $report->id) }}"> <i class="fa fa-chevron-left"></i> Back to
                            Overview </a>

                        <a class="pull-right" data-toggle="popover" data-html="true" data-animation="true" data-placement="left" title="Report Information" 
                          data-content="Report ID: {{ $report->id }} <br>
                          Evaluation ID: {{ $evaluation->id }} <br><hr>
                          Practitioner: {{ $practitioner->fname }} {{ $practitioner->sname }} <br>
                          Practitioner email: {{ $practitioner->email }}<br><hr>
                          Client: {{ $client->fname }} {{ $client->sname }}<br>
                          Client email: {{ $client->email }}"> 

                            <small style="color:#111;font-size:0.9em;"><i  class="fa fa-info-circle"></i> Information </small>

                        </a>   

                         <small>  <!-- For Future PDF function -->
                            <a style="padding-right:15px;" class="pull-right" href="#"> 
                            <i class="fa fa-file-pdf-o"></i> Download PDF </a>
                        </small>
                       
                    </div>
                </div>
                <!-- /.form-group -->

                        <hr>
                        {!! Form::open(['url' => 'reports/evaluation/update']) !!}
                        <input type="hidden" name="evaluation_id" value= {{ $evaluation->id }}>
                        @include('show_report')

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <br>
<script>

        $(function () {
          $('[data-toggle="popover"]').popover()
        })
        
   </script>

@endsection

@stop