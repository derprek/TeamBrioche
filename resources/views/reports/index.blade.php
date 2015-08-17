@extends('patientmaster')

@section('sidemenubar')
<ul class="nav navbar-nav side-nav">
	<li class="active">
        <a href="reports"><i class="fa fa-fw fa-dashboard"></i> Reports</a>
    </li>
    <li>
        <a href="reports/userhistory"><i class="fa fa-fw fa-bar-chart-o"></i> History</a>
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
                                    <i class="fa fa-dashboard"></i>  <a href="#">Dashboard</a>
                                </li>                              
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                     <!-- Dynamic Table -->

                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Create a New Report</a></li>
                         @if($latestreport->prac_notes != 'dummy record')
                        <li><a data-toggle="tab" href="#menu1">Current Report</a></li>  
                        @endif               
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                        	  <!-- Main jumbotron for a primary marketing message or call to action -->
                    <div class="jumbotron">
              
                        <p>Please select a section according to your needs:</p>
                        
                        <div class="row">
                            <!-- .col-sm-4 -->
                            <div class="col-sm-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Step 1</h3>
                                    </div>
                                    <div class="panel-body" style="text-align: center;">
                                       Do you want or need assistive equipment? <br><br>
                                       <a href="reports/create">
                                        <button type="button" class="btn btn-primary">Assessment</button>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    Status: 
                                </div>
                            </div>
                        </div>
                        <!-- /.col-sm-4 -->
                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Step 2</h3>
                                </div>
                                <div class="panel-body" style="text-align: center;">
                                    What kind of assistance or equipment do you require? <br><br>
                                    <a href="#">
                                        <button type="button" class="btn btn-primary">Typology</button>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    Status: 
                                </div>
                            </div>
                        </div>
                        <!-- /.col-sm-4 -->
                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title" >Step 3</h3>
                                </div>
                                <div class="panel-body" style="text-align: center;">
                                    Which products have you tested or selected before? <br><br>
                                    <a href="#">
                                        <button type="button" class="btn btn-primary">AT Selection</button>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    Status: 
                                </div>
                            </div>
                        </div>
                        <!-- /.col-sm-4 -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

    <div id="menu1" class="tab-pane fade">  <!-- Second tab -->
           
		@if (empty($latestreport->id))

		
		 @else

			<article>

				<h2> Report Number: {{ $latestreport->id }} </h2>
			
				
			<div class ="body" style="float:right"> Status:  {{ $latestreport-> status }} </div>
			<br>
			<hr/>
				</article>

				

					<div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Question </th>
		       							 <th>Answer</th>	
                                    </tr>
                                </thead>

                                @if(empty($managers[0]))
                                	<tr>
						     			<td> Create a new Report </td>	        
								    </tr>
                                   @else             	            
                                <tbody>

                                  @for ($i = 0; $i < $questionslength; $i++)
								    <tr>
						     			<td>{{ $questions[$i] }} </td>
								        <td>{{ $managers[$i]->answers}} </td>		        
								    </tr>
								  @endfor
                                    
                                </tbody>
                               @endif
                            </table>
                        </div>	
           <h4>
			<a class="btn btn-primary" href ="{{ url('/reports', $latestreport->id) }}">Edit Report </a>
			</h4>
			<br>
            <hr/>

            	<h4> Products you have selected </h4>
            	<div class="table-responsive" id ="producttable">
                   <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Product </th>
       							 <th>Manufactorer</th>	
       							 <th>Category</th>
       							 <th>Price</th>		
                            </tr>
                        </thead>
                @if(empty($patproductarray[0]))
                  	
                  	 <tbody>
                		<tr> 
                			<td>No Items Listed yet</td>
                		</tr>
                	 </tbody>
                @else
                        <tbody>

                          @foreach($patproductarray as $patproductlist)
						    <tr>
				     			<td>{{ $patproductlist->name }} </td>
						        <td>{{ $patproductlist->manufactorer}} </td>
						        <td>{{ $patproductlist->category }} </td>
						        <td>{{ $patproductlist->price}} </td>		        
						    </tr>
						  @endforeach
                            
                        </tbody>

                 @endif
                        </table>
                        <h4>
						<a class="btn btn-primary" href ="reports/create/products">Add a Product </a>
					</h4>
                </div>	
                <hr/>
                <br>

                 
            	<h4> Products you have selected before </h4>   <!-- Product History-->
            	<div class="table-responsive" id ="previousproducttable">
                   <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Product </th>
       							 <th>Manufactorer</th>	
       							 <th>Category</th>
       							 <th>Price</th>		
                            </tr>
                        </thead>
                                	
                  	 <tbody>
                		<tr> 
                			<td>No Items Listed yet</td>
                		</tr>
                	 </tbody>   

                        </table>
                        <h4>
						<a class="btn btn-primary" href ="#">Add a Product </a>
					</h4>
                </div>	

                <hr/>
                <br>

                
            	<h4> Recommended items from Practitioner </h4>   <!-- Product History-->
            	<div class="table-responsive" id ="pracproducttable">
                   <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Product </th>
       							 <th>Manufactorer</th>	
       							 <th>Category</th>
       							 <th>Price</th>		
                            </tr>
                        </thead>
                                	
                  	 @if(empty($pracproductarray[0]))
                  	
                  	 <tbody>
                		<tr> 
                			<td>No Items Listed yet</td>
                		</tr>
                	 </tbody>
                @else
                        <tbody>

                          @foreach($pracproductarray as $pracproductlist)
						    <tr>
				     			<td>{{ $pracproductlist->name }} </td>
						        <td>{{ $pracproductlist->manufactorer}} </td>
						        <td>{{ $pracproductlist->category }} </td>
						        <td>{{ $pracproductlist->price}} </td>		        
						    </tr>
						  @endforeach
                            
                        </tbody>

                 @endif

                        </table>
                       
                        	<label for ="pracnotes" >Practitioner's Notes</label>
							<textarea name ='pracnotes'class="form-control" rows="7" disabled> {{ $latestreport->prac_notes }}</textarea>
				
                </div>	


           				<br>

            		

				@endif
					  			</div>

			                 </div>
			                </div>
						 </div>

			                 <!-- /dynamic Table -->
						 </div>
			@endsection
			@stop