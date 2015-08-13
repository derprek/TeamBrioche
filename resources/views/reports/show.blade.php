@extends('app')

@section('content')
 <div class="dashboardbody">
@foreach($managers as $manager)
<article>


 <div class="tile-wide bg-red fg-white" data-role="tile" data-toggle="modal" data-target=<?php echo '#myModal' . $manager->question_id ?>
>
                <div class="tile-content iconic">
                    <span class="icon mif-cloud"></span>
                    <span class="tile-label">Question: {{ $manager->question_id }}</span>
                </div>
            </div>
           
			</a>
</article>

{!! Form::open(['url' => 'reports']) !!}
<div class="modal fade" role="dialog" id=<?php echo 'myModal' . $manager->question_id ?>>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Edit Question {{ $manager->report_id }}</h4>
      </div>
      <div class="modal-body">
        <p>Question: {{ $manager->question_id }}</p>
        <label 
        {!! Form::label('answer', 'Answer:') !!}
		{!! Form::textarea('answer',  $manager->answers , ['class' => 'form-control']) !!}
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-success" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


@endforeach

{!! Form:: submit('Update' , ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}
</div>

@stop