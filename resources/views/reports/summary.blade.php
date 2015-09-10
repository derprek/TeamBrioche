@extends('practitionermaster')

@section('sidemenubar')
	<ul class="nav navbar-nav side-nav">
		<li>
			<a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">
			<a href="{{ url('practitioner/reports') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
		</li>
		<li>
			<a href="{{ url('practitioner/questions') }}"><i class="fa fa-pencil"></i> Question Manager</a>
		</li>
	</ul>
@endsection

@section('content')

{!! Form::open(['url' => 'reports']) !!}

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
		{!! Form:: submit('Submit Report' , ['class' => 'btn btn-success',]) !!}
		{!! Form::close() !!}

	</div>
</div>

@endsection
@stop