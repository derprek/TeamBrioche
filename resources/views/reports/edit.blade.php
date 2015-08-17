@extends('patientmaster')

@section('sidemenubar')
  <ul class="nav navbar-nav side-nav">
    <li class="active">
          <a href="/../reports"><i class="fa fa-fw fa-dashboard"></i> Reports</a>
      </li>
      <li>
          <a href="userhistory"><i class="fa fa-fw fa-bar-chart-o"></i> History</a>
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
                          <i class="fa fa-dashboard"></i>  <a href="/../reports">Dashboard</a>
                      </li>  
                      <li class="active">
                          <i class="fa fa-desktop"></i> Edit Report
                      </li>                            
                  </ol>
              </div>
          </div>

    {!! Form::open(['url' => 'reports/summary']) !!}
      
      <?php $arrayCount = count($questions); ?>

          @for($x = 0; $x < $arrayCount; $x++)
    
    <article>

    <div class="form-group">
        <label for = <?php echo 'answersid' . $questions[$x]->id; ?>>Question {{ $questions[$x]->id }}: {{ $questions[$x]->question }}</label>
        <textarea name =<?php echo 'answersid' . $questions[$x]->id; ?> class="form-control" rows="7">{{ $managers[$x]->answers}}</textarea>
    </div>
    </article>

    <hr/>

    @endfor

    <a href="/../reports" class="btn btn-info">Back</a>



{!! Form::close() !!}
</div>
</div>

@stop
