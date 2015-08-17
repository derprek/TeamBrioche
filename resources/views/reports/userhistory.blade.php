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
                                    <i class="fa fa-desktop"></i> Report History
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                   

           <h4> My Report History</h4>
		      

		         	 <table class="table table-bordered table-hover table-striped">

		         		<tr>
		         			<th>Report Number </th>
					        <th>Status</th>
					        <th>Created on</th>
					        <th>Updated on</th>					        
					    </tr>
			           
                       @if(empty($reports[0]))

                         <tr>                           
                            <td> No Records </td>
                         </tr>  

                        @else

			         @foreach($reports as $report)	

		         		<tr>		         			
		         			<td> {{ $report->id }}  </td>
		         			<td> {{ $report->status }}  </td>
		         			<td> {{ $report->created_at }}  </td>
		         			<td> {{ $report->updated_at }}  </td>
		         		</tr>		     

			         @endforeach
                     @endif

		         	</table>
      			 


                 
			 </div>
			 </div>
		 

@endsection
@stop