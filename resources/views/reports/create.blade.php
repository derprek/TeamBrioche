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
                          <i class="fa fa-desktop"></i> Create a new Report
                      </li>                            
                  </ol>
              </div>
          </div>

    {!! Form::open(['url' => 'reports/summary']) !!}
    @foreach($questions as $question)
    <article>

   <!-- <div class="col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Question: {{ $question->id }}</h3>
                </div>
                <div class="panel-body" data-toggle="modal" data-target=<?php echo '#myModal' . $question->id ?> style="text-align: center;">
                    {{ $question->question }}<br><br>              
                    <button type="button" class="btn btn-primary">Click to Answer</button>
                </div>
            <div class="panel-footer">
                Status: 
            </div>
        </div>
    </div> -->

    <div class="form-group">
        <label for = <?php echo 'answersid' . $question->id; ?>>Question {{ $question->id }}: {{ $question->question }}</label>
        <textarea name =<?php echo 'answersid' . $question->id; ?> class="form-control" rows="7"></textarea>
    </div>
    </article>

    <hr/>







@endforeach

{!! Form:: submit('View a Summary' , ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}
</div>
</div>

@stop