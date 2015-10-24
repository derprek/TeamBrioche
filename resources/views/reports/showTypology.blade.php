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

                    @else

                        <li>
                            <i class="fa fa-bar-chart"></i> <a href="{{ url('practitioner/reportmanager') }}">Report
                                Manager</a>
                        </li>

                    @endif

                        <li>
                            <i class="fa fa-search"></i>
                            <a href="{{ url('/reports/overview', $report->id) }} ">Report
                                Overview</a>
                        </li>

                        <li>
                           Viewing <strong>Typology</strong> for Report: {{$report->id}}.
                        </li>

                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="form-group">

                <!-- Display client and practitioner name -->
                <div>
                    <br>
                <a class="pull-left" href="{{ url('/reports/overview', $report->id) }}"> <i class="fa fa-chevron-left"></i> Back to
                        Overview </a>

                    <a class="pull-right" data-toggle="popover" data-html="true" data-trigger="click" data-animation="true" data-placement="left" title="Report Information" 
                      data-content="Report ID: {{ $report->id }} <br> <hr>
                      Practitioner: {{ $practitioner->fname }} {{ $practitioner->sname }} <br>
                      Practitioner email: {{ $practitioner->email }}<br><hr>
                      Client: {{ $client->fname }} {{ $client->sname }}<br>
                      Client email: {{ $client->email }}"> 

                        <small style="color:#111;font-size:0.9em;"><i  class="fa fa-info-circle"></i> Information </small>

                    </a>

                    <small>
                        <a style="padding-right:15px;" class="pull-right" href="{{ url('/practitioner/Typology/reportpdf', $typology->id) }}"> 
                        <i class="fa fa-file-pdf-o"></i> Download PDF </a>
                    </small>
            
                </div>
                </div>
                <hr>
                {!! Form::open(['url' => 'reports/Typology/update']) !!}
                <input type="hidden" name="typology_id" value={{$typology->id}}>

               @include('show_report')
               
            </div>
        </div>

        <!-- /.container-fluid -->
    </div>

    <!-- /#page-wrapper -->
    <script type="text/javascript">
        $(function () {
          $('[data-toggle="popover"]').popover()
        })
    </script>
@endsection
@stop
