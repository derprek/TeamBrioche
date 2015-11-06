@extends('master.practitioner')

@section('sidemenubar')
    
    @include('partials.sidebar_reports')

@endsection

@section('content')
<link href="/css/main.css" rel="stylesheet">

<div id="page-wrapper">
    <div class="container-fluid">

      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                  &nbsp;
              </h1>
              <ol class="breadcrumb">

                  <li class="active">
                      <i class="fa fa-pencil"></i> Create a new Report
                  </li>

              </ol>
          </div>
      </div>

      <a class="directionLinks pull-left" href="{{ URL::previous() }}">
        <i class="fa fa-chevron-left"></i> Back
      </a>

      <br><br>
      {!! Form::open(['url' => 'reports']) !!} 
      @include('partials.reports.create_report')

    </div>
</div>

<script>
    $('#client_list').select2();    
</script>

@endsection