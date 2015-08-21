@extends('practitionermaster')

@section('sidemenubar')
<ul class="nav navbar-nav side-nav">
	<li class="active">
        <a href="/../practitioner/dashboard"><i class="fa fa-fw fa-dashboard"></i> Reports</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> History</a>
    </li>
    <li>
        <a href="/../practitioner/questions"><i class="fa fa-fw fa-bar-chart-o"></i>Question Manager</a>
    </li>
    <li>
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
                        <i class="fa fa-dashboard"></i>  <a href="/practitioner/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="{{  url('/practitioner', $_POST['reportid']) }}">Back to Report</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-desktop"></i> Add a Product
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <h3>Report No: <?php echo $_POST['reportid']; ?></h3><hr/>
        <h4> Recommend a Product to the Patient</h4>
        <table class="table table-bordered table-hover table-striped">
         <tr>
          <th>Select </th>
          <th>Product Name</th>
          <th>Manufactorer</th>
          <th>Category</th>
          <th>Price</th>
      </tr>
      {!! Form::open(['url' => 'practitioner/add']) !!}	
      @foreach($products as $product)
      <tr>
       <td> <input type ="checkbox" name ="productlist[]" value={{ $product->id}} </td>
       <td> {{ $product->name}}</td>
       <td> {{ $product->manufactorer}}</td>
       <td> {{ $product->category}}</td>
       <td> {{ $product->price}}</td>
   </tr>
   @endforeach

</table>

<input type ="hidden" name ="reportid" value = {{ $_POST['reportid'] }}>

{!! Form:: submit('Add Products' , ['class' => 'btn btn-primary form-control']) !!}         	
<!-- End New Products Modal -->

{!! Form::close() !!}

</div>
</div>

@endsection
@stop

