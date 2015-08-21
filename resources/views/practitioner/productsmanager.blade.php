@extends('practitionermaster')
@section('sidemenubar')
<ul class="nav navbar-nav side-nav">
  <li >
    <a href="/../practitioner/dashboard"><i class="fa fa-fw fa-dashboard"></i> Reports</a>
  </li>
  <li>
    <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> History</a>
  </li>
  <li>
    <a href="/../practitioner/questions"><i class="fa fa-fw fa-bar-chart-o"></i>Question Manager</a>
  </li>
  <li class="active">
    <a href="/../practitioner/productsmanager"><i class="fa fa-fw fa-bar-chart-o"></i>Product Manager</a>
  </li>

</ul>
@endsection

@section('content')

<<<<<<< HEAD
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
                                    <i class="fa fa-desktop"></i> Product Manager
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

            	<h3>Product Manager</h3>
            	<hr/>

		         	 <table class="table table-bordered table-hover table-striped" id="prodtable">

		         		<tr>
		         			<th>Name</th>
		         			<th>Manufactorer</th>
		         			<th>Category</th>
                  <th>Price</th>
                  <th>Updated On</th>  					       				       
					    </tr>
					   
             @if(empty($productsmanager))

              <tr>
                    <td> No Products found. </td>                            
                  </tr>

            @else

			         	@foreach($productsmanager as $products)
			         	
			         		<tr>
			         			<td>  {{ $products->name}} </td>	
			         			<td> {{ $products->manufactorer}} </td>	
			         			<td> {{ $products->category}} </td>	
                    <td> $ {{ $products->price}} </td> 
                    <td> {{ $products->updated_on}} </td>	         		         		
			         		</tr>

			         	@endforeach
			         	@endif
		         	</table>
	         	
      			  
		<button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newprod">Upload a new Product</button>     	
	<!-- End New Products Modal -->

                 
			 </div>
			 </div>
=======
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
            <i class="fa fa-desktop"></i> Product Manager
          </li>
        </ol>
      </div>
    </div>
    <!-- /.row -->

    <h3>Product Manager</h3>
    <hr/>
    <table class="table table-bordered table-hover table-striped" id="prodtable">
     <tr>
      <th>Name</th>
      <th>Manufactorer</th>
      <th>Category</th>
      <th>Price</th>
      <th>Updated On</th>  					       				       
    </tr>
    @if(empty($productsmanager))

    <tr>
      <td> No Products found. </td>                            
    </tr>

    @else
    @foreach($productsmanager as $products)
    <tr>
     <td>  {{ $products->name}} </td>	
     <td> {{ $products->manufactorer}} </td>	
     <td> {{ $products->category}} </td>	
     <td> $ {{ $products->price}} </td> 
     <td> {{ $products->updated_on}} </td>	         		         		
   </tr>

   @endforeach
   @endif
 </table>

 <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newprod">Upload a new Product</button>     	
 <!-- End New Products Modal -->
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47

</div>
</div>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="newprod" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span style="color:#000000">New Product</span></h4>
        </div>

        <div class="modal-body">
         {!! Form::open(['url' => 'practitioner/addproduct']) !!}
         <article>
           <div class="form-group" id ="qntable">
             <label for ="newquestion"> Product</label>
             <textarea required name = "prodname" class="form-control" rows="7" placeholder="Enter a new product"></textarea>
             <hr/>

<<<<<<< HEAD
			    <div class="form-group" id ="qntable">
			        <label for ="newquestion"> Product</label>
			        <textarea required name = "prodname" class="form-control" rows="3" placeholder="Enter the product's name"></textarea>
              <hr/>

              <label for ="prodcat"> Manufactorer:</label>
              <input required type="text" name="prodmanu" class="form-control" placeholder="Enter the manufactorer's name">
              <hr/>

              <label for ="cat_list"> Category:</label>
                <select id= "cat_list" name = "Catselect" class ="form-control" >
                 <option value = 'General' disabled selected>Please select a category</option>       
                          @foreach($categories as $cat)
                            <option value = {{ $cat->id}}>{{ $cat->name }}</option>
                          @endforeach                      
                </select>
              <hr/>

              <label for ="cat_list"> Sub-category:</label>
                <select id= "subcat_list" name = "Subcatselect" class ="form-control" >
                 <option value = 'General' disabled selected>Please select a sub-category</option>       
                          @foreach($categories as $cat)
                            <option value = {{ $cat->id}}>{{ $cat->name }}</option>
                          @endforeach                      
                </select>
              <hr/>

              <label for ="prodcat"> Price($):</label>
             <input required type="number" step="any" name="prodprice" class="form-control" placeholder="Enter the selling price of this product">
              <hr/>

              <div class = "form-group"> 
               <label for ="tag_list"> Tags:</label>
               <br>
              {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'tagslist', 'multiple']) !!}
               </div>
             

			    </div>

		    </article>


        </div>
        <div class="modal-footer">
      	
      	{!! Form:: submit('Add Product' , ['class' => 'btn btn-primary form-control']) !!}
      	<hr/>
        <button type="button" class="btn btn-info form-control" data-dismiss="modal">Close</button>

          {!! Form::close() !!}
        </div>
      </div>
       </form>
    </div>
  </div>
  
</div>
		 
	<script>

    $('#tag_list').select2();

  </script>        
=======
             <label for ="prodcat"> Manufactorer:</label>
             <input required type="text" name="prodmanu" class="form-control" placeholder="Enter the manufactorer's name">
             <hr/>

             <label for ="prodcat"> Category:</label>
             <input required type="text" name="prodcat" class="form-control" placeholder="Enter the product category">
             <hr/>

             <label for ="prodcat"> Price:</label>
             <input required type="number" step="any" name="prodprice" class="form-control" placeholder="Enter the selling price of this product">
             <hr/>

           </div>
         </article>
       </div>
       <div class="modal-footer">
         {!! Form:: submit('Add Product' , ['class' => 'btn btn-primary form-control']) !!}
         <hr/>
         <button type="button" class="btn btn-info form-control" data-dismiss="modal">Close</button>
         {!! Form::close() !!}
       </div>
     </div>
   </form>
 </div>
</div>
</div>
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47

@endsection
@stop

