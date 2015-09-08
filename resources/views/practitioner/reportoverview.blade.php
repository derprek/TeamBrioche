@extends('practitionermaster')


@section('content')

<div class="container">
  <!-- Modal -->
  <div class="modal fade" role="dialog" id ="reportoverview">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><span style="color:#000000">Report Overview: {{ $report_id}}</span></h4>
        </div>

        <div class="modal-body">
        
          
          <div class="col-sm-4 col-md-4" style="padding-top:40px;border-spacing: 10px 50px;">
              <div class="thumbnail" style="border: 1px outset black;padding:10px;">
                <br>
                <h3> Assessment</h3>
                <hr>
                <div class="caption">
                  <div class="checkbox">
                <label style="font-size: 2em">
                    <input type="checkbox" disabled value="" checked="" >
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                    Completed
                </label>
                <a href ="{{ url('/practitioner',$report_id) }}"><button type="button" id ="regbtn" class="btn btn-info form-control">View</button></a>
              </div>
                  <hr>
                </div>
              </div>
            </div>



            <div class="col-sm-4 col-md-4" style="padding-top:40px;border-spacing: 10px 50px;">
              <div class="thumbnail" style="border: 1px outset black;padding:10px;">
                <br>
                <h3> Typology</h3>
                <hr>
                <div class="caption">
                  <div class="checkbox">
                <label style="font-size: 2em">

                @if ($reportstepcount->contains(2))
                    <input type="checkbox" disabled value="" checked>
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                    Completed   
                    </label>
                    <button type="button" id ="regbtn" class="btn btn-info form-control">View</button>               
                @else 
                    <input type="checkbox" disabled value="" >
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                    Incomplete
                    </label>
                   <a href ="{{ url('/reports/createsteptwo',$report_id) }}"> <button type="button" id ="regbtn" class="btn btn-info form-control">Create</button></a>
                @endif
                   
                </label>
              </div>
                  <hr>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-md-4" style="padding-top:40px;border-spacing: 10px 50px;">
              <div class="thumbnail" style="border: 1px outset black;padding:10px;">
                <br>
                <h3> Selection </h3>
                <hr>
                <div class="caption">
                  <div class="checkbox">
                <label style="font-size: 2em">

                @if ($reportstepcount->contains(3))
                  <input type="checkbox" disabled value="" checked>
                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                  Completed   
                  </label>
                  <button type="button" id ="regbtn" class="btn btn-info form-control">View</button>               
                @else 
                  <input type="checkbox" disabled value="" >
                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                  Incomplete
                  </label>
                  <button type="button" id ="regbtn" class="btn btn-info form-control">Create</button>
                @endif

                </label>
              </div>
                  <hr>
                </div>
              </div>
            </div>
            
          
        </div>

        <div class="modal-footer">
        
        <hr/>
       <a href ="{{ url('practitioner/reports') }}"> <button type="button" class="btn btn-danger form-control" >Back</button></a>
        </div>
      </div>
       </form>
    </div>
  </div>

<script>
    $(document).ready(function(){
      $("#reportoverview").modal('show');
    });

    $('#reportoverview').modal({
      backdrop: 'static',
      keyboard: true
    })
 </script>

@endsection
@stop

