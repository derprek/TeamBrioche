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
            <i class="fa fa-dashboard"></i>  <a href="{{ url('practitioner/dashboard') }}">Dashboard</a>
          </li>  
          <li class="active">
            <i class="fa fa-desktop"></i> Create Step two
          </li>                            
        </ol>
      </div>
    </div>
    <a class="btn btn-default" href="{{ url('/practitioner/overview', $report_id) }}"> Back to Overview </a>
      <div class = "form-group"> 
      <hr>

       {!! Form::open(['url' => 'reports/createsteptwo']) !!}

    @unless($questions->isEmpty())

      <div class="row" >
      <input type="hidden" name="reportid" value = {{ $report_id }}>
      @foreach($questionslist as $questionlist)
          
          @foreach($questionlist as $questions)

                @if($questions->type === "thumbnail")

                  <div class="col-sm-6 col-md-6" style="padding-top:40px;border-spacing: 10px 50px;">
                    <div class="thumbnail" style="border: 1px outset black;padding:10px;">
                      <br>
                      <img style = "width:20%" src={{ $questions->imgpath }} >
                      <br>
                      <h4>{{ $questions->question }}</h4>
                      <hr>
                      <div class="caption">
                        <textarea class="form-control" name ="answersid[{{ $questions->id }}]" rows="3" placeholder="{{ $questions->placeholder }}"></textarea>
                        <hr>
                      </div>
                    
                  
                @else
                    <div class="form-group" style="padding:10px;">
                      <label for = "answersid[{{ $questions->id }}]">{{ $questions->question }}</label>
                         @if($questions->type === "tall")
                            <textarea name ="answersid[{{ $questions->id }}]" class="form-control" rows="3" placeholder="{{ $questions->placeholder }}"></textarea>
                           @elseif($questions->type === "regular")
                            <input type="text" name="answersid[{{ $questions->id }}]" class="form-control" placeholder="{{ $questions->placeholder }}">
                         @endif
                    </div>  
                @endif
         @endforeach
         </div>
         </div>
      @endforeach
      
    @endunless 
  </div>
  <hr>
  <div class="form-group" style="padding:3%;">
  {!! Form:: submit('Submit Step Two' , ['class' => 'btn btn-info form-control']) !!}
    {!! Form::close() !!}
    </div>
    </div>
    <br>
   
<script>

    $('#client_list').select2();

  </script>  

@stop