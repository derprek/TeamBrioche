@extends('practitionermaster')



@section('content')

<div id="page-wrapper">

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					&nbsp;
				</h1>
				<ol class="breadcrumb">

					<li class="active">
						<i class="fa fa-desktop"></i> Dashboard
					</li>
				</ol>
			</div>
		</div>

		<div class="col-lg-12">

			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home"><strong>View all Reports</strong></a></li>  
				<li><a data-toggle="tab" href="#menu1">In Progress</a></li>
				<li><a data-toggle="tab" href="#menu2">Finished </a></li>  
				<li><a data-toggle="tab" href="#menu3">Shared with me </a></li>             
			</ul>


			<div class="tab-content">
				<div id="home" class="tab-pane fade in active"> 
					<!-- 1st tab -->
					<table class="table table-bordered table-hover table-striped">

						@if($prac_reports->isEmpty())
						<tr>  No Records 
						</tr>

						@else

						<tr>
							<th>Report Number </th>
							<th>Patient Name</th>
							<th>Created on</th>
							<th>Updated on</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>

						@foreach($prac_reports as $reportlist)
						<tr>       			         			
							<td> {{ $reportlist->id}}</td>
							<td> {{ App\User::find($reportlist->userid)->name}}</td>
							<td> {{ $reportlist->created_at}}</td>
							<td> {{ $reportlist->updated_at}}</td>
							<td> {{ $reportlist->status}}</td>
							<td style="width:10%"> <a href ="{{ url('/practitioner/overview', $reportlist->id) }}" class="btn btn-info form-control"> Edit</a></td>       
						</tr>
						@endforeach
						@endif
					</table>
				</div>

				<div id="menu1" class="tab-pane fade">  <!-- 3rd tab -->
					<table class="table table-bordered table-hover table-striped">
						

						@if($progress->isEmpty())
						<tr>  No Records 
						</tr>

						@else

						<tr>
							<th>Report Number </th>
							<th>Patient Name</th>
							<th>Created on</th>
							<th>Updated on</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>

						@foreach($progress as $progresslist)
						<tr>			         			
							<td> {{ $progresslist->id}} </td>
							<td> {{ App\User::find($progresslist->userid)->name}}</td>
							<td> {{ $progresslist->created_at}}</td>
							<td> {{ $progresslist->updated_at}}</td>
							<td> {{ $progresslist->status}}</td>
							<td style="width:10%"> <a href ="{{ url('/practitioner/overview', $reportlist->id) }}" class="btn btn-info form-control"> Edit</a></td>       
						</tr>
						@endforeach
						@endif
					</table>
				</div>

				<div id="menu2" class="tab-pane fade">  <!-- 4th tab -->
					<table class="table table-bordered table-hover table-striped">
						
						@if($finished->isEmpty())
						<th> No Records 
						</th>
						@else

						<tr>
							<th>Report Number </th>
							<th>Patient Name</th>
							<th>Created on</th>
							<th>Updated on</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>

						@foreach($finished as $finishedlist)  
						<tr>			         			
							<td> {{ $finishedlist->id}} </td>
							<td> {{ App\User::find($finishedlist->userid)->name}}</td>
							<td> {{ $finishedlist->created_at}}</td>
							<td> {{ $finishedlist->updated_at}}</td>
							<td> {{ $finishedlist->status}}</td>
							<td style="width:10%"> <a href ="{{ url('/practitioner/overview', $reportlist->id) }}" class="btn btn-info form-control"> Edit</a></td>       
						</tr>
						@endforeach
						@endif
					</table>
				</div>

				<div id="menu3" class="tab-pane fade">  <!-- 4th tab -->
					<table class="table table-bordered table-hover table-striped">
						
						@if($finished->isEmpty())
						<th> No Records 
						</th>
						@else

						<tr>
							<th>Report Number </th>
							<th>Patient Name</th>
							<th>Created on</th>
							<th>Updated on</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>

						@foreach($shared as $sharedreports)  
						<tr>			         			
							<td> {{ $sharedreports->id}} </td>
							<td> {{ App\User::find($sharedreports->userid)->fname}}</td>
							<td> {{ $sharedreports->created_at}}</td>
							<td> {{ $sharedreports->updated_at}}</td>
							<td> {{ $sharedreports->status}}</td>
							<td style="width:10%"> <a href ="{{ url('/practitioner/overview', $reportlist->id) }}" class="btn btn-info form-control"> Edit</a></td>       
						</tr>
						@endforeach
						@endif
					</table>
				</div>
			</div>
				
			</div>
		</div>
	</div>
</div>

@endsection
@stop








