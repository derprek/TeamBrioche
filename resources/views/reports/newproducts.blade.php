@extends('patientmaster')

@section('sidemenubar')
<ul class="nav navbar-nav side-nav">
	<li class="active">
        <a href="/../reports"><i class="fa fa-fw fa-dashboard"></i> Reports</a>
    </li>
    <li>
        <a href="/../reports/userhistory"><i class="fa fa-fw fa-bar-chart-o"></i> History</a>
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
                                    <i class="fa fa-dashboard"></i>  <a href="{{  url('/practitioner', $latestreport->id)}}">Back to Report</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-desktop"></i> Add a Product
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                   

           <h4> What Assistive Technology do you desire?</h4>
		      

		         	 <table class="table table-bordered table-hover table-striped">

		         		<tr>
		         			<th>Select </th>
					        <th>Product Name</th>
					        <th>Manufactorer</th>
					        <th>Category</th>
					        <th>Price</th>
					    </tr>

			         	@foreach($products as $product)
			         	{!! Form::open(['url' => 'reports/newproducts']) !!}
			         		<tr>
			         			<td> <input type ="checkbox" name ="productlist[]" value={{ $product->id}} </td>
			         			<td> {{ $product->name}}</td>
			         			<td> {{ $product->manufactorer}}</td>
			         			<td> {{ $product->category}}</td>
			         			<td> {{ $product->price}}</td>
			         		</tr>

			         	@endforeach
			         	
		         	</table>
      			 
		{!! Form:: submit('Add Products' , ['class' => 'btn btn-primary form-control']) !!}         	
	<!-- End New Products Modal -->

	{!! Form::close() !!}

                 
			 </div>
			 </div>
		 
		       

@endsection
@stop

