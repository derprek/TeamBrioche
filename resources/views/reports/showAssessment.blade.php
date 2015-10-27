@extends('practitionermaster')

@section('sidemenubar')

 @if((Session::has('prac_id')) && (Session::has('is_admin')))
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li >
                    <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
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
    
 @elseif(Session::has('prac_id'))
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
                </li>
                <li class="active">
                    <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
                </li>
            </ul>
        </div>

  @elseif(Auth::check())
          
          <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav side-nav">
                  <li>
                      <a href="{{ url('home') }}"><i class="fa fa-home"></i> Dashboard</a>
                  </li>
                  <li class="active">
                      <a href="{{ url('client/reportarchives') }}"><i class="fa fa-bar-chart-o"></i> Reports</a>
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
                             <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart"></i>Report
                                Manager</a>
                        </li>
                        <li>
                            <a href="{{ url('/reports/overview', $report->id) }} "><i class="fa fa-search"></i>Report
                                Overview</a>
                        </li>
                        <li>
                            Viewing <strong>Assessment</strong> for Report: {{$report->id}}. 
                        </li>

                    @else

                       <li>
                            <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart"></i> Report
                                Manager</a>
                        </li>
                        <li>
                            <a href="{{ url('/reports/overview', $report->id) }} "><i class="fa fa-search"></i>Report
                                Overview</a>
                        </li>
                        <li>
                            Viewing <strong>Assessment</strong> for Report: {{$report->id}}.
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

                        @else

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

                            <span style="color:#111; padding-right:10px;"><i  class="fa fa-info-circle"></i> Information <b class="caret"></b></span>

                         </a>
                   
                        <a style="padding-right:30px;"class="pull-right" href="{{ url('/practitioner/reportpdf', $report->id) }}"> 
                        <i class="fa fa-file-pdf-o"></i>  Download PDF   </a>

                        @unless(Auth::check())
                         <span class="version-control pull-left" style="padding-left:40px;">   

                            <div class="dropdown" >

                                    <span class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-history"></i> Revision History <b class="caret"></b></span>
                                    
                                        <ul class="dropdown-menu">

                                          @foreach($versionlist as $version)
                                          
                                                @if($version['id'] === $assessment->current_version)
                                                    <li class="active" data-toggle="popover" data-html="true" data-trigger="hover" data-placement="right" 
                                                      data-content="Version Number: {{ $version['version_number'] }}<br>
                                                      Status: Active <br><br>
                                                      
                                                      Last update: {{ date('F d, Y', strtotime($version['updated_at'])) }} <br>
                                                      {{ date('h:ia', strtotime($version['updated_at'])) }} <hr>
                                                      By: {{ $version['practitioner_name'] }}"> 

                                                    <a href="#" >
                                                       
                                                        <i class="fa fa-check"></i>  
                                                        Version {{ $version['version_number']}} </a>
                                                    </li>
                                                    <li class="divider"></li>
                                                @else
                                                 
                                                    <li data-toggle="popover" data-html="true" data-trigger="hover" data-placement="right" 
                                                             data-content="Version Number: {{ $version['version_number'] }}<br>
                                                             Status: Inactive <br><br>

                                                              Last update: {{ date('F d, Y', strtotime($version['updated_at'])) }}  <br>
                                                              {{ date('h:ia', strtotime($version['updated_at'])) }} <hr>
                                                              By: {{ $version['practitioner_name'] }} <hr>
                                                              <strong> Click to rollback to this version </strong>">
                                                        <a data-toggle="modal" data-target="#changeVersionConfirmation{{ $version['id'] }}" > 
                                                        
                                                        <i class="fa fa-circle-thin"></i>
                                                         Version {{ $version['version_number'] }}</a>
                                                    </li>
                                                    <li class="divider"></li>


                                                @endif
                                               
                                          @endforeach
                                           
                                        </ul>
                            </div>
                        </span>
                      @endunless

                    </div>
                </div>

               <br>

                  {!! Form::open(['url' => 'reports/stepAssessment/checkhistory']) !!}
                    @unless(Auth::check())
                        <input type="hidden" name="report_id" value={{$report->id}}>
                        <input type="hidden" name="assessment_id" value={{$assessment->id}}>
                        <input type="hidden" name="current_version" value={{$currentversion['version_number']}}>
                    @endunless
                  @include('show_report')

            <!-- /.form-group -->
        </div>
        <!-- /.container-fluid -->
        @unless(Auth::check())
         @foreach($versionlist as $version)

             @include('partials.changeVersionConfirmationModal')   

         @endforeach
        @endunless

    </div>

    <script>

        $(function () {
          $('[data-toggle="popover"]').popover()
        });

         $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });
        
   </script>

@endsection
@stop
