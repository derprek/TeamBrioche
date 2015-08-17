@extends('practitionermaster')

@section('sidemenubar')
<ul class="nav navbar-nav side-nav">
  <li >
        <a href="/../practitioner/dashboard"><i class="fa fa-fw fa-dashboard"></i> Reports</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> History</a>
    </li>
    <li class="active">
        <a href="/../practitioner/questions"><i class="fa fa-fw fa-bar-chart-o"></i>Question Manager</a>
    </li>
    <li >
        <a href="/../practitioner/productsmanager"><i class="fa fa-fw fa-bar-chart-o"></i>Product Manager</a>
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
                                    <i class="fa fa-dashboard"></i>  <a href="/../practitioner/dashboard">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-desktop"></i> Question Manager
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

            	<h3>Question Manager</h3>
            	<hr/>

		         	 <table class="table table-bordered table-hover table-striped">

		         		<tr>
		         			<th>Question</th>
		         			<th>Created on</th>
		         			<th>Modified on</th>					       				       
					    </tr>
					
			         	@foreach($questionlist as $question)
			         	
			         		<tr>
			         			<td> {{ $question->question}} </td>	
			         			<td> {{ $question->created_at}} </td>	
			         			<td> {{ $question->updated_at}} </td>		         		         		
			         		</tr>

			         	@endforeach
			         	
		         	</table>
	         	<hr/>
      			 
		<button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newqn">Add a Question</button>     	
	<!-- End New Products Modal -->

                 
			 </div>
			 </div>

<div class="container">
 
  

  <!-- Modal -->
  <div class="modal fade" id="newqn" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span style="color:#000000">New Question</span></h4>
        </div>
        <div class="modal-body">

         {!! Form::open(['url' => 'practitioner/addquestion']) !!}
        	<article>

			    <div class="form-group" id ="qntable">
			        <label for ="newquestion"> Question</label>
			        <textarea name = "newquestion" class="form-control" rows="7" placeholder="Enter a new question"></textarea>
			    </div>

		    </article>


        </div>
        <div class="modal-footer">
      	
      	{!! Form:: submit('Add Question' , ['class' => 'btn btn-primary form-control']) !!}
      	<hr/>
        <button type="button" class="btn btn-info form-control" data-dismiss="modal">Close</button>

          {!! Form::close() !!}
        </div>
      </div>
       </form>
    </div>
  </div>
  
</div>
		 
		       

@endsection
@stop

