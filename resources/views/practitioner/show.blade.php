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
                              <i class="fa fa-dashboard"></i>  <a href="/../practitioner/dashboard">Dashboard</a>
                          </li>                  

                          <li class="active">
                              <i class="fa fa-desktop"></i> View Report
                          </li>
                      </ol>
                  </div>
              </div>
              <!-- /.row -->          

           <h2>Report: {{$reports->id}}</h2>
            <input type="hidden" name="reportid" value ={{$reports->id}}>
                   <a href= "{{ url('/practitioner/generate', $reports->id) }}"> generate report </a>


             <div class="dashboardbody">
              

             <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <p style ="float:right"> Client's name: {{ $client-> name}} </p>
                  <thead>
                    <tr>
                      <th>Question </th>
                      <th>Answer</th>  
                    </tr>
                  </thead>

                  <tbody>
                    @for ($i = 0; $i < $questionlistlength; $i++)

                    <tr>
                      <td>{{ $questions[$i] }} </td>
                      <td>{{ $managers[$i]->answers}} </td>           
                    </tr>

                   @endfor
              
                  </tbody>
                  
                </table>
              </div>

              <hr/>
               <div class="table-responsive">
                <h4> Products ordered by the patient </h4>
                <table class="table table-bordered table-hover table-striped">  <!-- client's products -->                
                
                  <thead>
                    <tr>
                     <th>Product </th>
                     <th>Manufactorer</th>  
                     <th>Category</th>
                     <th>Price</th>   
                    </tr>
                  </thead>
              
                     @if(empty($patproductarray))
                    
                       <tbody>
                          <tr> 
                            <td>No Items Listed yet</td>
                          </tr>
                       </tbody>

                    @else
                        
                        @foreach($patproductarray as $patlist)
                          <tbody>                     
                              <tr>
                                <td>{{ $patlist->name }} </td>
                                <td>{{ $patlist->manufactorer}} </td>
                                <td>{{ $patlist->category }} </td>
                                <td>{{ $patlist->price}} </td>            
                              </tr>                                      
                          </tbody>
                        @endforeach    

                     @endif

                  </table>

                </div> 

                 <hr/>

                <!-- Previous Products Table --> 
               <div class="table-responsive">
                <h4> Products tried previously by the patient </h4>
                <table class="table table-bordered table-hover table-striped">  <!-- client's products -->                
                
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

                </div> 

                <!-- Recommend products table -->
                <hr/>
                <div class="table-responsive" id ="recommendproducttable">
                <h4> Recommend a product to the patient </h4>
                <table class="table table-bordered table-hover table-striped">  <!-- client's products -->                
                
                  <thead>
                    <tr>
                     <th>Product </th>
                     <th>Manufactorer</th>  
                     <th>Category</th>
                     <th>Price</th>   
                    </tr>
                  </thead>
                
                @if(empty($pracproductarray))
                   <tbody>
                      <tr> 
                        <td>No Items Listed yet</td>
                      </tr>
                   </tbody>

                   @else
                        
                        @foreach($pracproductarray as $praclist)
                          <tbody>                     
                              <tr>
                                <td>{{ $praclist->name }} </td>
                                <td>{{ $praclist->manufactorer}} </td>
                                <td>{{ $praclist->category }} </td>
                                <td>{{ $praclist->price}} </td>            
                              </tr>                                      
                          </tbody>
                        @endforeach    

                     @endif

                 </table>

       {!! Form::open(['url' => 'practitioner/products']) !!}
          <h4>
                 <input type="hidden" name="reportid" value ={{$reports->id}}>
           {!! Form:: submit('Add a Product' , ['class' => 'btn btn-primary']) !!}
          </h4>
                </div> 
        {!! Form::close() !!}
                 <hr/>

         {!! Form::open(['url' => 'practitioner/update']) !!}
                <div class="form-group">
                    <label for = "prac_notes"> Practitioner's Notes: </label>
                    <textarea name ="prac_notes" class="form-control" rows="7">{{ $reports->prac_notes }}</textarea>
                </div>
               

              <hr/>

          <label for = "ReportStatus"> Report Status: </label>
          <select id= "status" name = "ReportStatus" >
                 <option value = 'Pending Review' selected>{{ $reports-> status }}</option>
                 <!--<option onclick="mycatFunction()">Pending Review</option> -->
                 <option value = 'In Progress'>In Progress</option>
                 <option value="Finished">Finished</option>

          </select>

           <hr/>
         {!! Form:: submit('Update Report' , ['class' => 'btn btn-primary form-control']) !!}
          <!--{!! Form:: submit('Summarize Report', ['class' => 'btn btn-primary form-control']) !!}-->
          <input type="hidden" name="reportid" value ={{$reports->id}}>

         {!! Form::close() !!}
        </div>
                              
       </div>
       </div>
     

@endsection
@stop




         

       



<script>
function mycatFunction() {
    var x = document.getElementById("status").selectedIndex;
    document.getElementById("categorygetter").value  =   (document.getElementsByTagName("option")[x].value);
}
</script>
