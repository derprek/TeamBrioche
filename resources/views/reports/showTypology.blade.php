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
                        
                    @if(Session::has('prac_id'))
                        @if(Session::has('is_admin'))

                            <li>
                                 <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart"></i>Report
                                    Manager</a>
                            </li>

                          @else

                            <li>
                                 <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart"></i>Report
                                    Manager</a>
                            </li>

                        @endif

                        <li>
                            <a href="{{ url('/reports/overview', $report->id) }} "><i class="fa fa-search"></i>Report
                                Overview</a>
                        </li>

                        <li class="active">
                           Viewing <strong>Typology</strong> for Report: {{$report->id}}.
                        </li>

                    @elseif(Auth::check())

                        <li>
                               <a href="{{ url('/client/reportarchives') }}"><i class="fa fa-bar-chart-o"></i> View all reports</a>
                        </li>
                        <li>
                            <a href="{{ url('/reports/overview', $report->id) }} "><i class="fa fa-search"></i>Report
                                Overview</a>
                        </li>
                        <li class="active">
                              Viewing <strong>Typology</strong> for Report: {{$report->id}}.
                        </li>

                    @endif
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="form-group">

                <!-- Display client and practitioner name -->
                <div>
                    <br>
                @if(Auth::check())

                    <a class="directionLinks pull-left" href="{{ url('/client/reportarchives') }}">
                     <i class="fa fa-chevron-left"></i> Back 
                    </a>

                @elseif(Session::has('prac_id'))

                     <a class="directionLinks pull-left" href="{{ url('/reports/overview', $report->id) }}"> 
                        <i class="fa fa-chevron-left"></i> Back to Overview 
                    </a>

                @endif
               
                
                    <a class="pull-right" data-toggle="popover" data-html="true" data-trigger="hover" data-animation="true" data-placement="left" title="Report Information" 
                      data-content="Report ID: {{ $report->id }} <br> <hr>
                      Practitioner: {{ $practitioner->fname }} {{ $practitioner->sname }} <br>
                      Practitioner email: {{ $practitioner->email }}<br><hr>
                      Client: {{ $client->fname }} {{ $client->sname }}<br>
                      Client email: {{ $client->email }}"> 

                        <small style="color:#111;font-size:0.9em;"><i  class="fa fa-info-circle"></i> Information </small>

                    </a>
                    <!--
                    <small>
                        <a style="padding-right:15px;" class="pull-right" href="{{ url('/practitioner/Typology/reportpdf', $typology->id) }}"> 
                        <i class="fa fa-file-pdf-o"></i> Download PDF </a>
                    </small> -->
            
                </div>
                </div>
                <br>
                {!! Form::open(['url' => 'reports/Typology/update']) !!}
                <input type="hidden" name="typology_id" value={{$typology->id}}>

               @include('show_report')
               
            </div>
        </div>

        <!-- /.container-fluid -->
    </div>

    <!-- /#page-wrapper -->
@endsection
@stop
