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
    
    <h4>Report Summary</h4>          
    {!! Form::open(['url' => 'practitioner/update']) !!}
    <h2>{{$reports->id}}</h2>
    <input type="hidden" name="reportid" value ={{$reports->id}}>
    <div class="dashboardbody">
     <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>Question </th>
            <th>Answer</th>  
          </tr>
        </thead>
        <tbody>
          @for ($i = 0; $i < $questionslength; $i++)
          <tr>
            <td>{{ $questions[$i] }} </td>
            <td>{{ $managers[$i]->answers}} </td>           
          </tr>
          @endfor
        </tbody>
      </table>
    </div>  
    <select id= "status" name = "ReportStatus">
     <option value="" onchange ="mycatFunction()" selected>{{ $reports-> status }}</option>
     <!--<option onclick="mycatFunction()">Pending Review</option> -->
     <option value = 'In Progress'>In Progress</option>
     <option value="Finished">Finished</option>
   </select>
   {!! Form:: submit('Update Report' , ['class' => 'btn btn-primary form-control']) !!}
   <!--{!! Form:: submit('Summarize Report', ['class' => 'btn btn-primary form-control']) !!}-->
   {!! Form::close() !!}
   <h2> {{ $client-> name}} </h2>
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

@stop