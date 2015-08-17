@extends('patientmaster')

@section('sidemenubar')
<ul class="nav navbar-nav side-nav">
	<li class="active">
        <a href="/../reports"><i class="fa fa-fw fa-dashboard"></i> Reports</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> History</a>
    </li>
    </ul>
@endsection

@section('content')

	{!! Form::open(['url' => 'reports']) !!}
	<input type="hidden" name="Finalanswersid1" value ={{ $arrayAnswer[0]}}>
	<input type="hidden" name="Finalanswersid2" value ={{ $arrayAnswer[1]}}>
	<input type="hidden" name="Finalanswersid3" value ={{ $arrayAnswer[2]}}>
	<input type="hidden" name="Finalanswersid4" value ={{ $arrayAnswer[3]}}>
	<input type="hidden" name="Finalanswersid5" value ={{ $arrayAnswer[4]}}>
	<input type="hidden" name="Finalanswersid6" value ={{ $arrayAnswer[5]}}>
	<input type="hidden" name="Finalanswersid7" value ={{ $arrayAnswer[6]}}>
	<input type="hidden" name="Finalanswersid8" value ={{ $arrayAnswer[7]}}>
	<input type="hidden" name="Finalanswersid9" value ={{ $arrayAnswer[8]}}>

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
                                    <i class="fa fa-dashboard"></i>  <a href="/../reports">Back to Report</a>
                                </li>

                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="/../reports/create">Create a New Report</a>
                                </li>

                                <li class="active">
                                    <i class="fa fa-desktop"></i> Report Summary
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                   

           <h4>Report Summary</h4>		      

           		

		         	 <table class="table table-bordered table-hover table-striped">

						<?php 

						$arrayCount = count($arrayAnswer);

						for($x = 0; $x < $arrayCount; $x++) {
						echo "<tr>";
							echo "<td> $questions[$x]</td>";
							echo "<td> $arrayAnswer[$x] </td>";
						echo "</tr>";
					    };
						?>
						
					</table>

				<a href="/../reports" class="btn btn-info">Back</a>
				{!! Form:: submit('Submit Report' , ['class' => 'btn btn-primary',]) !!}
				{!! Form::close() !!}
      			                  
			 </div>
			 </div>
		 

@endsection
@stop