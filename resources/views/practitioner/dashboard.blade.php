@extends('practitionermaster')

@section('sidemenubar')
<ul class="nav navbar-nav side-nav">
	<li class="active">
        <a href="#"><i class="fa fa-fw fa-dashboard"></i> Reports</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> History</a>
    </li>
    <li>
        <a href="questions"><i class="fa fa-fw fa-bar-chart-o"></i> Question Manager</a>
    </li>
    <li>
        <a href="productsmanager"><i class="fa fa-fw fa-bar-chart-o"></i> Product Manager</a>
    </li>
    </ul>
@endsection

@section('content')
	
		<div id="page-wrapper">

            <div class="container-fluid">

                    <!-- Page Heading -->
                   
                    <!-- /.row -->
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
                <li class="active"><a data-toggle="tab" href="#home">Last Edited Report</a></li>
                <li><a data-toggle="tab" href="#menu1">Pending Review</a></li>
                <li><a data-toggle="tab" href="#menu2">In Progress</a></li>
                <li><a data-toggle="tab" href="#menu3">Finished </a></li>                  
            </ul>


            <div class="tab-content">
                <div id="home" class="tab-pane fade in active"> <!-- 1st tab -->
                	
                	 <table class="table table-bordered table-hover table-striped">

                	  	<tr>
		         			<th>Report Number </th>
					        <th>Patient Name</th>
					        <th>Created on</th>
					        <th>Updated on</th>
					        <th>Status</th>
					    </tr>

					   		@if(empty($latestreport->id))

					   		    <tr>			         			
			         				<td> No Recent Reports</td>
			         			</tr>

					   		     @else
			         		<tr>			         			
			         			<td> <a href ="{{ url('/practitioner', $latestreport->id) }}"> {{ $latestreport->id}}</a></td>
			         			<td> {{ App\User::find($latestreport->userid)->name}}</td>
			         			<td> {{ $latestreport->created_at}}</td>
			         			<td> {{ $latestreport->updated_at}}</td>
			         			<td> {{ $latestreport->status}}</td>
			         		</tr>
			         		 @endif

                	  </table>  
                	 
          
   				 </div>
            <!-- /.container-fluid -->

    		<div id="menu1" class="tab-pane fade">  <!-- 2nd tab -->
           
				  <table class="table table-bordered table-hover table-striped">

                	  	<tr>
		         			<th>Report Number </th>
					        <th>Patient Name</th>
					        <th>Created on</th>
					        <th>Updated on</th>
					        <th>Status</th>
					    </tr>

					    @if(empty($pending))

					    	<tr> <td> No Records </td>
					    	</tr>

					    @else
					     @foreach($pending as $pendinglist)

					   		<tr>			         			
			         			<td> <a href ="{{ url('/practitioner', $pendinglist->id) }}"> {{ $pendinglist->id}}</a></td>
			         			<td> {{ App\User::find($pendinglist->userid)->name}}</td>
			         			<td> {{ $pendinglist->created_at}}</td>
			         			<td> {{ $pendinglist->updated_at}}</td>
			         			<td> {{ $pendinglist->status}}</td>
			         		</tr>
			         		@endforeach
					    @endif

					   
			     
			         		

			         	

                	  </table>
		  			</div>

		  	<div id="menu2" class="tab-pane fade">  <!-- 3rd tab -->
           		
           		 <table class="table table-bordered table-hover table-striped">

                	  	<tr>
		         			<th>Report Number </th>
					        <th>Patient Name</th>
					        <th>Created on</th>
					        <th>Updated on</th>
					        <th>Status</th>
					    </tr>

					     @if(empty($progress))

					    	<tr> <td> No Records </td>
					    	</tr>

					    @else

					    @foreach($progress as $progresslist)
			     
			         		<tr>			         			
			         			<td> <a href ="{{ url('/practitioner', $progresslist->id) }}"> {{ $progresslist->id}} </a></td>
			         			<td> {{ App\User::find($progresslist->userid)->name}}</td>
			         			<td> {{ $progresslist->created_at}}</td>
			         			<td> {{ $progresslist->updated_at}}</td>
			         			<td> {{ $progresslist->status}}</td>
			         		</tr>
			         	

			         	@endforeach

			         	 @endif

                	  </table>
				
		  	</div>

		  	<div id="menu3" class="tab-pane fade">  <!-- 4th tab -->

		  	<table class="table table-bordered table-hover table-striped">

                	  	<tr>
		         			<th>Report Number </th>
					        <th>Patient Name</th>
					        <th>Created on</th>
					        <th>Updated on</th>
					        <th>Status</th>
					    </tr>

					    @if(empty($progress))

					    	<tr> <td> No Records </td>
					    	</tr>

					    @else

					    @foreach($finished as $finishedlist)  
			 
			         		<tr>			         			
			         			<td> <a href ="{{ url('/practitioner', $finishedlist->id) }}"> {{ $finishedlist->id}} </a></td>
			         			<td> {{ App\User::find($finishedlist->userid)->name}}</td>
			         			<td> {{ $finishedlist->created_at}}</td>
			         			<td> {{ $finishedlist->updated_at}}</td>
			         			<td> {{ $finishedlist->status}}</td>
			         		</tr>

			         	@endforeach
			         	@endif

                	  </table>
		  	</div>

	     </div>
	    </div>


	</div>
	</div>

	@endsection

@stop



                         

           		

		        
      		