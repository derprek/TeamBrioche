@extends('practitionermaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li>
            <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
        </li>
        <li class="active">
            <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
        </li>
        <li>
            <a href="{{ url('practitioner/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('practitioner/dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <i></i><a href="{{ url('practitioner/reportmanager') }}"> Report Manager</a>
                        </li>
                        <li>
                            <i></i> <a href="{{ url('/practitioner/overview', $report->id) }}"> Report Overview</a>
                        </li>
                        <li class="active">
                            <i></i> Selection Manager
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12">

                        <a class="btn btn-success"
                          href="{{ url('/reports/createSelection',$report->id) }}"
                          role="button">Create a new selection</a>
                        <hr>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><strong>View all Selection reports</strong></a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <!-- 1st tab -->
                        <table class="table table-bordered table-hover table-striped">

                            @if(empty($selectionlist))
                                <tr> No Records
                                </tr>

                            @else

                                <tr>
                                    <th>Selection Number</th>
                                    <th>Product</th>
                                    <th>Practitioner</th>
                                    <th>Updated on</th>
                                    <th>View</th>
                                </tr>

                                <!-- List out reports -->
                                @foreach($selectionlist as $reportlist)
                                    <tr>
                                        <td> {{ $reportlist['id'] }}</td>
                                        <td> {{ $reportlist['product'] }}</td>
                                        <td> {{ $reportlist['name'] }}</td>
                                        <td> {{ $reportlist['date'] }}</td>
                                        <td>  <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Options
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/reports/Selection',$reportlist['id']) }}">View</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#{{$reportlist['id']}}">Delete</a></li>
                                        </ul>
                                      </div></td>
                                      <!--  <td style="width:10%">
                                        @$select_id = $reportlist['id'] 
                                        <a href="{{ url('/reports/Selection',$reportlist['id']) }}"
                                         class="btn btn-success btn-sm form-control"> Edit
                                        </a></td>-->
                                    </tr>


                                    <div class="container">
                    <!-- Create new client Modal -->
                    <div class="modal fade" id="{{$reportlist['id']}}" role="dialog">
                        <div class="modal-dialog ">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><span style="color:#000000">Delete</span></h4>
                                </div>

                                <div class="modal-body">

                                                <!-- Registration form -->
                                        <form role="form" method="POST" action="{{ url('/reports/selection/delete') }}">
                                            <input type="hidden" name="selectid" value="{{ $reportlist['id'] }}">
                                            <input type="hidden" name="reportid" value="{{ $report->id }}">
                                            
                                                <h4> Are you sure you want to delete Selection {{$reportlist['id']}} </h4>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary form-control">Confirm
                                                </button>
                                                <br><br>
                                                <button type="button" class="btn btn-danger form-control"
                                                        data-dismiss="modal">Close
                                                </button>
                                            </div>
                                            <!-- /.modal-footer -->
                                        </form>
                                </div>
                                <!-- /.modal-body -->
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
                <!-- /.container -->
                                @endforeach
                            @endif
                        </table>
                    </div>
               
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
@endsection
@stop








