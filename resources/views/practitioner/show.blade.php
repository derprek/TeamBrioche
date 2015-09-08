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

    <h2>Report: {{$report->id}}</h2>
    <input type="hidden" name="reportid" value ={{$report->id}}>
    
    <div>
    <a class = "btn btn-info" href= "{{ url('/practitioner/generate', $report->id) }}"> generate report </a>
    <p style ="float:right"> Client's name: {{ $clientinfo->fname}} {{ $clientinfo->sname}} </p>
    <br>
    <br>
    <p style ="float:right"> Practitioner's name: {{ $pracinfo->name }} </p>
    <br>
    </div>
    <div class="dashboardbody">

    <hr>

    @foreach($answerlist as $reportinfo)
     <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        
        <thead>
          <tr>
            <th>Question </th>
            <th>Answer</th>  
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>

           @foreach($reportinfo as $reportlist)
            <tr>
              <td style="width:25%">{{ $reportlist->question }} </td>
              <td style="width:65%">{{ $reportlist->pivot->answers}} </td> 
              <td style="width:10%">    <button type="button" id ="regbtn" class="btn btn-info form-control" data-toggle="modal" data-target=<?php echo "#update". $reportlist->pivot->rqid;?>>Edit</button> </td>          
            </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
    <hr/>
    @endforeach
    <hr/>
    
</div>
</div>
</div>

@foreach($answerlist as $reportinfo)
  <input type="hidden" name="reportid" value ={{$report->id}}>
    @foreach($reportinfo as $reportlist)
      
      <div class="container">
  <!-- Modal -->
  <div class="modal fade" role="dialog" id =<?php echo "update" . $reportlist->pivot->rqid ?> >
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span style="color:#000000">Update Report</span></h4>
        </div>

        <div class="modal-body">
          
        
        <form role="form" method="POST" action="{{ url('/reports/pracAnswersUpdate') }}">

          <div class="form-group" id ="qntable">
              <input type='hidden' name='rqid' value= {{ $reportlist->pivot->rqid }}> 
              <input type="hidden" name="reportid" value ={{$report->id}}>
              <label for ="fname"> {{ $reportlist->question}}</label>
              <textarea class="form-control" name ="answersid[{{ $reportlist->pivot->rqid }}]" rows="5">{{ $reportlist->pivot->answers}}</textarea>
                <br>
          </div>
        </div>

        <div class="modal-footer">
        
        <button type="submit" class="btn btn-info form-control">Update</button>
        <hr/>
        <button type="button" class="btn btn-danger form-control" data-dismiss="modal">Close</button>

       
        </div>
      </div>
       </form>
    </div>
  </div>

    @endforeach
          
@endforeach

@endsection
@stop
